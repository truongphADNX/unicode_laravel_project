<?php

namespace Modules\Categories\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CategoriesRepositoryInterface extends RepositoryInterface{

    public function getCategoriess();
    public function getAllCategories();
}
