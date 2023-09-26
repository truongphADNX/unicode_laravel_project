<?php

namespace Modules\Teacher\src\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Teacher\src\Models\Teacher;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepository;

class TeacherController extends Controller
{

    protected $teacherRepository;
    public function __construct(TeacherRepository $teacherRepository)
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
                return $teacher->image ? '<img src="https://www.lightenyourway.com/wp-content/uploads/2014/07/smiling-dogIMG.jpg" class="teacher__img">' : '';
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
        return;
    }

    public function store(TeacherRequest $teacherRequest)
    {
        return;
    }

    public function edit($id)
    {
        return;
    }

    public function update(TeacherRequest $teacherRequest, $id)
    {
        return;
    }
    public function delete($id)
    {
        return;
    }
}
