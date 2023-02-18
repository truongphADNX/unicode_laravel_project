<?php

namespace Modules\Categories\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
