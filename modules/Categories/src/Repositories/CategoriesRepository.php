<?php

namespace Modules\Categories\src\Repositories;

use Modules\Categories\src\Models\Category;
use App\Repositories\BaseRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;


class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getCategoriess()
    {
        return $this->model->get();
    }

    public function getAllCategories()
    {
        return $this->model->with('subCategories')
        ->whereParentId(0)->select([
            'id',
            'name',
            'slug',
            'created_at'
        ])->latest();
    }
}
