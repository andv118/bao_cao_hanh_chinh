<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use Auth;

class ThongKeController extends Controller
{

  public function hoithuocsonganh(){
    return view('thongke/thongkehoithuocsonganh');
  }

  public function hoithuocquanhuyen(){
    return view('thongke/thongkehoithuocquanhuyen');
  }

  
}