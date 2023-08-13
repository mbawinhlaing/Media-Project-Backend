<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendPostController extends Controller
{
     //Driect TrendPost Page
     public function index(){
        return view('admin.trend.index');
    }
}
