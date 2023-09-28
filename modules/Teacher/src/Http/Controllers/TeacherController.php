<?php

namespace Modules\Teacher\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Modules\Teacher\src\Models\Teacher;
use Yajra\DataTables\Facades\DataTables;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class TeacherController extends Controller
{

    protected $teacherRepository;
    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function index()
    {
        $pageTitle = 'Quan ly giao vien';

        return view('teacher::list_teachers', compact('pageTitle'));
    }

    public function data()
    {
        $teachers = $this->teacherRepository->getTeachers();
        return DataTables::of($teachers)
            ->editColumn('image', function ($teacher) {
                return $teacher->image ? '<img src="' . $teacher->image . '" class="teacher__img">' : '';
            })
            ->editColumn('created_at', function ($teacher) {
                return Carbon::parse($teacher->created_at)->format('Y/m/d h:i:s');
            })
            ->addColumn('update', function ($teacher) {
                return '<a href="' . route('admin.teachers.edit', $teacher) . '" class="btn btn-warning">Update</a>';
            })
            ->addColumn('delete', function ($teacher) {
                return '<a href="' . route('admin.teachers.delete', $teacher) . '" class="btn btn-danger delete-action">Delete</a>';
            })
            ->rawColumns(['update', 'delete', 'image'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = 'Them moi giao vien';

        return view('teacher::add_teacher', compact('pageTitle'));
    }

    public function store(TeacherRequest $teacherRequest)
    {
        $data = $teacherRequest->except('_method', '_token');
        $teacher = $this->teacherRepository->create($data);
        if ($teacher) {
            return redirect()->route('admin.teachers.index')->with('msg', __('teacher::messages.create.success'));
        }
        return back()->with('msg', __('teacher::messages.create.failure'));
    }

    public function edit($id)
    {
        $teacher = $this->teacherRepository->find($id);

        $pageTitle = 'Cập nhật giao vien';

        if (!$teacher) {
            abort(404);
        }
        return view('teacher::edit_teacher', compact(['pageTitle', 'teacher']));
    }

    public function update(TeacherRequest $teacherRequest, $id)
    {
        $data = $teacherRequest->except('_method', '_token');

        $teacher = $this->teacherRepository->update($id, $data);

        if ($teacher) {
            return redirect()->route('admin.teachers.index')->with('msg', __('teacher::messages.update.success'));
        }
        return back()->with('msg', __('teacher::messages.update.failure'));
    }
    public function delete($id)
    {
        $teacher = $this->teacherRepository->find($id);

        $result = $this->teacherRepository->delete($id);
        if ($result) {
            $image = $teacher->image;
            deleteFileStorage($image);
            return back()->with('msg', __('teacher::messages.delete.success'));
        }
    }
}
