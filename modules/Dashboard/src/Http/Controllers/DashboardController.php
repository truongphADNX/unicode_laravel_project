<?php

namespace Modules\Dashboard\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Dashboard\src\Models\Dashboard;
class DashboardController extends Controller{
    public function index() {
        $pageTitle = 'Dashboard';
        return view('dashboard::dashboard',compact('pageTitle'));
    }
}