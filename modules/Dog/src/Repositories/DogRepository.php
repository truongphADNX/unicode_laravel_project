<?php

namespace Modules\Dog\src\Repositories;

use Modules\Dog\src\Models\Dog;
use App\Repositories\BaseRepository;
use Modules\Dog\src\Repositories\DogRepositoryInterface;


class DogRepository extends BaseRepository implements DogRepositoryInterface
{
    public function getModel() {
        return Dog::class;
    }

    public function getDogs($limit=10){
        return $this->model->limit($limit)->get();
    }
}
