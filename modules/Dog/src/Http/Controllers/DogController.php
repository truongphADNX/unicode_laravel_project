<?php

namespace Modules\Dog\src\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Dog\src\Models\Dog;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Dog\src\Http\Requests\DogRequest;
use Modules\Dog\src\Repositories\DogRepository;

class DogController extends Controller{

    protected $dogRepository;
    public function __construct(DogRepository $dogRepository)
    {
        $this->dogRepository = $dogRepository;
    }

    public function index() {

        $pageTitle = '';

        return view('dog::list_dogs',compact('pageTitle'));
    }

    public function data() {
        return;
    }

    public function create() {
        return;
    }

    public function store(DogRequest $dogRequest){
        return;
    }

    public function edit($id){
        return;
    }

    public function update(DogRequest $dogRequest, $id){
        return;
    }
    public function delete($id){
        return;
    }
}
