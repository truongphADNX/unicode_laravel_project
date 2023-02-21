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
        $word = "news";
        $name = "Category";
        $migrationFile = base_path('modules/'. $name. '/migrations/'.date('Y_m_d_His').'_create_'.strtolower(ConvertNoun($name,true)).'_table.php');
        dd($migrationFile);
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index()
    {
        $pageTitle = "Quan ly danh muc";

        $categories = $this->categoriesRepository->getAllCategories()->get();;

        return view("categories::list", compact(['pageTitle']));
    }

    public function data()
    {
        $categories = $this->categoriesRepository->getAllCategories()->get();

        $categories = DataTables::of($categories)
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
            ->toArray();

            $categories['data'] = $this->getCategoriesTable($categories['data']);
           return $categories;
    }

    public function getCategoriesTable($categories, $char = "", &$result = []){
        if ($categories) {
            foreach ($categories as $key => $category) {
                $row = $category;
                $row['name'] = $char.$row['name'];
                $row['created_at'] = Carbon::parse($row['created_at'])->format('Y/m/d h:i:s');
                $row['update'] = '<a href="' . route('admin.categories.edit', $row['id']) . '" class="btn btn-warning">Update</a>';
                $row['delete'] = '<a href="' . route('admin.categories.delete', $row['id']) . '" class="btn btn-danger delete-action">Delete</a>';
                $row['link'] = '<a href="#" class="btn btn-primary">View</a>';

                //Nếu thay $row bằng $category thì sẽ unset luôn các subcaregoris trong parent_categories.
                unset($row['sub_categories']);
                unset($row['updated_at']);
                unset($row['parent_id']);
                $result[] = $row;
                if (!empty($category['sub_categories'])) {
                    $this->getCategoriesTable($category['sub_categories'], $char.'|--', $result);
                }
            }
        }
        return $result;
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
