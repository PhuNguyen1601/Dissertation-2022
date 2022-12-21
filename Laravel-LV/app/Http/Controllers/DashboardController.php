<?php

namespace App\Http\Controllers;
use Toastr;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }
}