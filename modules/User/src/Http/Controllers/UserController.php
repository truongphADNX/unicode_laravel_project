<?php

namespace Modules\User\src\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\src\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller{

    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {

        $pageTitle = 'Quan ly nguoi dung';

        return view('user::list',compact('pageTitle'));
    }

    public function data() {
        $users = $this->userRepository->getAllUsers();
        return DataTables::of($users)
                ->addColumn('update', function($user){
                    return '<a href="'.route('admin.users.edit',$user).'" class="btn btn-warning">Update</a>';
                })
                ->addColumn('delete', function($user){
                    return '<a href="'.route('admin.users.delete',$user).'" class="btn btn-danger delete-action">Delete</a>';
                })
                ->editColumn('created_at', function($user){
                    return Carbon::parse($user->created_at)->format('Y/m/d h:i:s');
                })
                ->rawColumns(['update', 'delete'])
                ->toJson();
    }

    public function create() {

        $pageTitle = 'Them moi nguoi dung';

        return view('user::add',compact('pageTitle'));
    }

    public function store(UserRequest $userRequest){

        $this->userRepository->create(
                [
                    'name' => $userRequest->fullName,
                    'username' => $userRequest->userName,
                    'password' => bcrypt($userRequest->password),
                    'email' => $userRequest->email,
                    'group_id' => $userRequest->group_id,
                ]
            );
        return  redirect()->route('admin.users.index')->with('msg', __('user::messages.create.success'));
    }

    public function edit($id){

        $user = $this->userRepository->find($id);

        $pageTitle = 'Cập nhật người dùng';

        if (!$user) {
            abort(404);
        }

        return view('user::edit',compact(['user','pageTitle']));
    }

    public function update(UserRequest $userRequest, $id){
        $data = $userRequest->except('_token', 'password');
        if($userRequest->password){
            $data['password'] = bcrypt($userRequest->password);
        }
        $this->userRepository->update($id,$data);

        return back()->with('msg', __('user::messages.update.success'));
    }
    public function delete($id){
        $this->userRepository->delete($id);

        return back()->with('msg', __('user::messages.delete.success'));
    }
}
