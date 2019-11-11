<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use Auth;

class DanhmucController extends Controller
{

  public function danhmuccoquan(){
    return view('danhmuc/coquan');
  }

  public function danhmuclinhvuc(){
    return view('danhmuc/linhvuc');
  }

  public function danhmucquanhuyen(){
    return view('danhmuc/quanhuyen');
  } 

  public function danhmucxaphuong(){
    return view('danhmuc/xaphuong');
  }


  

 
}
