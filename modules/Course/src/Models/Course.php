<?php

namespace Modules\Course\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    ////Cấu hình Timestamp
    //public $timestamps = true;

    ////khoa chinh
    //protected $primaryKey = 'id';

    ////Trong trường hợp khóa chính không ở chế độ Auto_Increment và không phải kiểu số, hãy khai báo thêm thuộc tính sau:
    //public $incrementing = false;

    ////Thay đổi kiểu dữ liệu cho khóa chính
    //protected $keyType = 'string';

    ////Trong trường hợp muốn thay đổi Database Connection của 1 Model nào đó, hãy bổ sung thuộc tính sau
    //protected $connection = 'ten_connection';

    protected $fillable = [
        'name', 'slug', 'detail', 'teacher_id', 'thumbnail', 'price', 'sale_price',
        'code', 'durations', 'is_document', 'supports', 'status'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_courses', 'course_id', 'category_id');
    }
}
