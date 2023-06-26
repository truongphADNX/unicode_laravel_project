<?php

namespace Modules\Course\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $table = 'categories_courses';

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
       'course_id', 'category_id'
    ];

    public function categories(){
        return $this->belongsToMany(Categories::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class);
    }
}
