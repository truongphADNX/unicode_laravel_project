<?php

namespace Modules\Course\src\Repositories;

use Modules\Course\src\Models\Course;
use App\Repositories\BaseRepository;
use Modules\Course\src\Repositories\CourseRepositoryInterface;


class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses($limit = 10)
    {
        return $this->model->select([
            'id', 'name', 'status', 'price', 'created_at'
        ]);
    }
}
