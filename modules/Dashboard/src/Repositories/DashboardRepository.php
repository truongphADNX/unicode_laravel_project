<?php

namespace Modules\Dashboard\src\Repositories;

use Modules\Dashboard\src\Models\Dashboard;
use App\Repositories\BaseRepository;
use Modules\Dashboard\src\Repositories\DashboardRepositoryInterface;


class DashboardRepository extends BaseRepository implements DashboardRepositoryInterface
{
    public function getModel() {
        return Dashboard::class;
    }

    public function getDashboards($limit=10){
        return $this->model->limit($limit)->get();
    }
}
