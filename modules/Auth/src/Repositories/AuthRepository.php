<?php

namespace Modules\Auth\src\Repositories;

use Modules\Auth\src\Models\Auth;
use App\Repositories\BaseRepository;
use Modules\Auth\src\Repositories\AuthRepositoryInterface;


class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getModel() {
        return Auth::class;
    }

    public function getAuths($limit=10){
        return $this->model->limit($limit)->get();
    }
}
