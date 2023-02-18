<?php

namespace Modules\Categories\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Http\Requests\CategoriesRequest;
use Modules\Categories\src\Repositories\CategoriesRepository;

class CategoriesController extends  Controller
{
    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index()
    {
        $pageTitle = "Quan ly danh muc";

        return view("categories::list", compact(['pageTitle']));
    }

    public function data()
    {
        $categories = $this->categoriesRepository->getAllCategories()->get();;
        return DataTables::of($categories)
            ->addColumn('update', function ($category) {
                return '<a href="' . route('admin.categories.edit', $category) . '" class="btn btn-warning">Update</a>';
            })
            ->addColumn('delete', function ($category) {
                return '<a href="' . route('admin.categories.delete', $category) . '" class="btn btn-danger delete-action">Delete</a>';
            })
            ->addColumn('link', function ($category) {
                return '<a href="#" class="btn btn-primary">View</a>';
            })
            ->editColumn('created_at', function ($category) {
                return Carbon::parse($category->created_at)->format('Y/m/d h:i:s');
            })
            ->rawColumns(['update', 'delete', 'link'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = "Create categories";

        $categories = $this->categoriesRepository->getCategoriess();

        return view('categories::add', compact(['pageTitle','categories']));
    }

    public function store(CategoriesRequest $categoriesRequest)
    {
        $data = $categoriesRequest->except('_token');
        $this->categoriesRepository->create($data);

        return  redirect()->route('admin.categories.index')->with('msg', __('categories::messages.create.success'));
    }

    public function edit($id)
    {
        $pageTitle = "edit categories";
        $category = $this->categoriesRepository->find($id);
        $categories = $this->categoriesRepository->getCategoriess();
        return view('categories::edit', compact(['pageTitle','categories', 'category']));
    }

    public function update(CategoriesRequest $categoriesRequest, $id)
    {
        $data = $categoriesRequest->except('_token', '_method');
        $this->categoriesRepository->update($id, $data);

        return back()->with('msg', __("categories::messages.update.success"));
    }

    public function delete($id)
    {
        $this->categoriesRepository->delete($id);

        return back()->with('msg', __('categories::messages.delete.success'));
    }
}
