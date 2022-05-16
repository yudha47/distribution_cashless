<?php

namespace App\Http\Controllers;

use App\Models\AvgTime;
use Illuminate\Http\Request;
use App\Models\TimeProductivity;

class ProductivityController extends Controller{
  public function index(){
    $time = TimeProductivity::all();
    $avg = AvgTime::all();
    return view('productivity', [
                                'title' => 'wallboard',
                                'time' => $time,
                                'avg' => $avg,
                                ]);
  }
}
