<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use Auth;

class CauhoidanhgiaController extends Controller
{

  public function cauhoidanhgia(){
    return view('cauhoidanhgia/home');
  }


  
}