<?php

namespace Modules\Dashboard\src\Repositories;

use App\Repositories\RepositoryInterface;

interface DashboardRepositoryInterface extends RepositoryInterface{

    public function getDashboards();
}
