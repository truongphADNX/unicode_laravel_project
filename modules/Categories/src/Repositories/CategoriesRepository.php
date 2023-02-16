<?php

namespace Modules\Categories\src\Repositories;

use Modules\Categories\src\Models\Category;
use App\Repositories\BaseRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;


class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    public function getModel() {
        return Category::class;
    }

    public function getCategoriess($limit=10){
        return $this->model->limit($limit)->get();
    }

    public function getAllCategories(){
        return  $this->model->select([
            'id',
            'name',
            'slug',
            'created_at'
        ])->get();
    }
}