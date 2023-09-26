<?php

namespace Modules\Course\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Course\src\Models\Course;
use Yajra\DataTables\Facades\DataTables;
use Modules\Course\src\Http\Requests\CourseRequest;
use Modules\Course\src\Repositories\CourseRepository;
use Modules\Categories\src\Repositories\CategoriesRepository;

class CourseController extends Controller
{

    protected $courseRepository;
    protected $categoriesRepository;
    public function __construct(CourseRepository $courseRepository, CategoriesRepository $categoriesRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->categoriesRepository =  $categoriesRepository;
    }

    public function index()
    {

        $pageTitle = 'Danh sach khoa hoc';

        return view('course::list_courses', compact('pageTitle'));
    }

    public function data()
    {
        $courses = $this->courseRepository->getAllCourses()->get();
        return DataTables::of($courses)
            ->addColumn('update', function ($course) {
                return '<a href="' . route('admin.courses.edit', $course) . '" class="btn btn-warning">Update</a>';
            })
            ->addColumn('delete', function ($course) {
                return '<a href="' . route('admin.courses.delete', $course) . '" class="btn btn-danger delete-action">Delete</a>';
            })
            ->addColumn('status', function ($course) {
                return $course->status == 0  ? '<button class="btn btn-primary">Active</button>' : '<button class="btn btn-danger">InActive</button>';
            })
            ->addColumn('price', function ($course) {
                $price = $course->sale_price;
                if ($course->price) {
                    if ($course->sale_price) {
                        $price = number_format($course->sale_price) . ' đ';
                    } else {
                        $price = number_format($course->price) . ' đ';
                    }
                } else {
                    $price = "Free";
                }
                return $price;
            })
            ->editColumn('created_at', function ($course) {
                return Carbon::parse($course->updated_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['update', 'delete', 'status', 'price'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = 'Create Course';
        $categories = $this->categoriesRepository->getAllCategories();
        return view('course::add_course', compact(['pageTitle', 'categories']));
    }

    public function store(CourseRequest $courseRequest)
    {
        DB::beginTransaction();
        try {
            $courses = $courseRequest->except(['_token', '_method']);
            if (!$courses['price']) {
                $courses['price'] = 0;
            }
            if (!$courses['sale_price']) {
                $courses['sale_price'] = 0;
            }
            $course = $this->courseRepository->create($courses);
            $categories = $this->getCategories($courses);
            $this->courseRepository->createCourseCategories($course, $categories);
            DB::commit();
            return redirect()->route('admin.courses.index')->with('msg', __('course::messages.create.success'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.courses.index')->with('msg', __('course::messages.create.failure'));
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Course';
        $course = $this->courseRepository->find($id);
        $categoryIds = $this->courseRepository->getRelatedCategories($course);
        $categories = $this->categoriesRepository->getAllCategories();
        return view('course::edit_course', compact('pageTitle', 'course', 'categories', 'categoryIds'));
    }

    public function update(CourseRequest $courseRequest, $id)
    {
        DB::beginTransaction();
        try {
            $courses = $courseRequest->except(['_method', '_token']);
            if (!$courses['price']) {
                $courses['price'] = 0;
            }
            if (!$courses['sale_price']) {
                $courses['sale_price'] = 0;
            }
            $this->courseRepository->update($id, $courses);
            $course = $this->courseRepository->find($id);
            $categories = $this->getCategories($courses);
            $this->courseRepository->updateCourseCategories($course, $categories);
            DB::commit();
            return back()->with('msg', __('course::messages.update.success'));
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('msg', __('course::messages.update.failure'));
        }
    }
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $course = $this->courseRepository->find($id);
            $this->courseRepository->deleteCourseCategories($course);
            $this->courseRepository->delete($id);
            DB::commit();
            return back()->with('msg', __('course::messages.delete.success'));
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('msg', __('course::messages.delete.failure'));
        }
    }

    private function getCategories($courses)
    {
        $categories = [];

        foreach ($courses['categories'] as $category) {
            $categories[$category] = ['created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')];
        }

        return $categories;
    }
}
