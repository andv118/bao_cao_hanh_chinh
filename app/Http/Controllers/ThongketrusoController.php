<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use Auth;

class ThongketrusoController extends Controller
{

  public function nhanuoc(){
    return view('thongketruso/nhanuoc');
  }

  public function tutuc(){
    return view('thongketruso/tutuc');
  }


 
}
