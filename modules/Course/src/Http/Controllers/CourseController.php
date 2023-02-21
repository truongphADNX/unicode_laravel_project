<?php

namespace Modules\Course\src\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Course\src\Models\Course;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Course\src\Http\Requests\CourseRequest;
use Modules\Course\src\Repositories\CourseRepository;

class CourseController extends Controller{

    protected $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index() {

        $pageTitle = 'Danh sach khoa hoc';

        return view('course::list_courses',compact('pageTitle'));
    }

    public function data() {
        $courses = $this->courseRepository->getAllCourses()->get();
        return DataTables::of($courses)
            ->addColumn('update',function($course){
                return '<a href="'.route('admin.courses.edit',$course).'" class="btn btn-warning">Update</a>';
            })
            ->addColumn('delete',function($course){
                return '<a href="'.route('admin.courses.delete',$course).'" class="btn btn-danger delete-action">Delete</a>';
            })
            ->addColumn('link',function($course){
                return '<a target=_blank href="#" class="btn btn-info">View</a>';
            })
            ->editColumn('created_at', function($course){
                return Carbon::parse($course->updated_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['update','delete','link'])
            ->toJson();
    }

    public function create() {
        $pageTitle = 'Create Course';
        return view('course::add_course',compact('pageTitle'));
    }

    public function store(CourseRequest $courseRequest){
    }

    public function edit($id){
        $pageTitle = 'Edit Course';
        $course = $this->courseRepository->find($id);
        return view('course::edit_course',compact('pageTitle','course'));
    }

    public function update(CourseRequest $courseRequest, $id){
    }
    public function delete($id){
        $course = $this->courseRepository->delete($id);
        return back()->with('msg',__('course::messages.delete.success'));
    }
}
