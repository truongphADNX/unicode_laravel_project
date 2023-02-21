<?php

namespace Modules\Dog\src\Repositories;

use App\Repositories\RepositoryInterface;

interface DogRepositoryInterface extends RepositoryInterface{

    public function getDogs();
}
