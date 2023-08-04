<?php

namespace Modules\Course\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Course\src\Models\Course;
use Yajra\DataTables\Facades\DataTables;
use Modules\Course\src\Http\Requests\CourseRequest;
use Modules\Course\src\Repositories\CourseRepository;
use Modules\Categories\src\Repositories\CategoriesRepository;

class CourseController extends Controller{

    protected $courseRepository;
    protected $categoriesRepository;
    public function __construct(CourseRepository $courseRepository, CategoriesRepository $categoriesRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->categoriesRepository =  $categoriesRepository;
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
            ->addColumn('status',function($course){
                return $course->status == 0  ? '<button class="btn btn-primary">Active</button>' : '<button class="btn btn-danger">InActive</button>' ;
            })
            ->addColumn('price',function($course){
                $price = $course->sale_price;
                if($course->price){
                    if ($course->sale_price) {
                        $price = number_format($course->sale_price).' đ';
                    }else {
                        $price = number_format($course->price).' đ';
                    }
                }else {
                    $price = "Free";
                }
                return $price;
            })
            ->editColumn('created_at', function($course){
                return Carbon::parse($course->updated_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['update','delete','status', 'price'])
            ->toJson();
    }

    public function create() {
        $pageTitle = 'Create Course';
        $categories = $this->categoriesRepository->getAllCategories();
        return view('course::add_course',compact(['pageTitle','categories']));
    }

    public function store(CourseRequest $courseRequest){
        dd($courseRequest->all());
        $course = $courseRequest->except(['_token','_method']);

        if (!$course['price']) {
            $course['price'] = 0;
        }

        if (!$course['sale_price']) {
            $course['sale_price'] = 0;
        }

        $course = $this->courseRepository->create($course);

        $this->courseRepository->createCourseCategories($course, $courseRequest['categories']);

        return redirect()->route('admin.courses.index')->with('msg', __('course::messages.create.success'));
    }

    public function edit($id){
        $pageTitle = 'Edit Course';
        $course = $this->courseRepository->find($id);
        return view('course::edit_course',compact('pageTitle','course'));
    }

    public function update(CourseRequest $courseRequest, $id){
        $course = $courseRequest->except(['_method','_token']);
        $this->courseRepository->update($id,$course);

        return back()->with('msg', __('course::messages.update.success'));
    }
    public function delete($id){
        $course = $this->courseRepository->delete($id);
        return back()->with('msg',__('course::messages.delete.success'));
    }
}
