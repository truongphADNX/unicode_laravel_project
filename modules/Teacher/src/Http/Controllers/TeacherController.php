<?php

namespace Modules\Teacher\src\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Teacher\src\Models\Teacher;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepository;

class TeacherController extends Controller{

    protected $teacherRepository;
    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function index() {

        $pageTitle = '';

        return view('teacher::list_teachers',compact('pageTitle'));
    }

    public function data() {
        return;
    }

    public function create() {
        return;
    }

    public function store(TeacherRequest $teacherRequest){
        return;
    }

    public function edit($id){
        return;
    }

    public function update(TeacherRequest $teacherRequest, $id){
        return;
    }
    public function delete($id){
        return;
    }
}
