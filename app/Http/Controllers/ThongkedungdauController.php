<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use Auth;

class ThongkedungdauController extends Controller
{

  public function kiemnghiem(){
    return view('thongkedungdau/kiemnghiem');
  }

  public function gioitinh(){
    return view('thongkedungdau/gioitinh');
  }


  public function tuoi(){
    return view('thongkedungdau/tuoi');
  }


 
}
