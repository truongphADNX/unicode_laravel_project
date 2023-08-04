<?php

namespace Modules\Categories\src\Models;

use Modules\Course\src\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }

    public function subCategories()
    {
        return $this->children()->with('subCategories');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'categories_courses', 'course_id', 'category_id');
    }
}
