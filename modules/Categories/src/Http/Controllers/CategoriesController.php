<?php

namespace Modules\Categories\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Categories\src\Http\Requests\CategoriesRequest;
use Modules\Categories\src\Repositories\CategoriesRepository;

class CategoriesController extends Controller{
    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index() {
        $pageTitle = "Quan ly danh muc";

        return view("categories::list",compact(['pageTitle']));
    }

    public function data(){
        $categories = $this->categoriesRepository->getAllCategories();
        return DataTables::of($categories)
        ->addColumn('update', function($category){
            return '<a href="'.route('admin.categories.edit',$category).'" class="btn btn-warning">Update</a>';
        })
        ->addColumn('delete', function($category){
            return '<a href="'.route('admin.categories.delete',$category).'" class="btn btn-danger delete-action">Delete</a>';
        })
        ->editColumn('created_at', function($category){
            return Carbon::parse($category->created_at)->format('Y/m/d h:i:s');
        })
        ->rawColumns(['update', 'delete'])
        ->toJson();
    }

    public function create(){
        $pageTitle = "Create categories";
        return view('categories::add', compact('pageTitle'));
    }

    public function store(CategoriesRequest $categoriesRequest){
        $data = $categoriesRequest->except('_token');
        $this->categoriesRepository->create($data);

        return  redirect()->route('admin.categories.index')->with('msg', __('categories::messages.create.success'));
    }

    public function edit(){

    }

    public function update(){}

    public function delete(){}

}
