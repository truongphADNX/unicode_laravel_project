<?php

namespace Modules\Teacher\src\Repositories;

use Modules\Teacher\src\Models\Teacher;
use App\Repositories\BaseRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;


class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface
{
    public function getModel()
    {
        return Teacher::class;
    }

    public function getTeachers($limit = 10)
    {
        return $this->model->select([
            'id', 'name', 'exp', 'image', 'created_at'
        ])->latest();
    }
}
