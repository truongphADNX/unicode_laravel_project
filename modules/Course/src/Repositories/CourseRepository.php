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
            'id', 'name', 'status', 'price', 'sale_price', 'created_at'
        ])->latest();
    }

    public function createCourseCategories($course, $data)
    {
        return $course->categories()->attach($data);
    }

    public function updateCourseCategories($course, $data)
    {
        return $course->categories()->sync($data);
    }

    public function deleteCourseCategories($course)
    {
        return $course->categories()->detach();
    }

    public function getRelatedCategories($course)
    {
        $categoryIds = $course->categories()->allRelatedIds()->toArray();
        return $categoryIds;
    }
}
