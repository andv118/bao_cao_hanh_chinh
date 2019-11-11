<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use Auth;

class PhieudanhgiaController extends Controller
{

  public function phieudanhgia(){
    return view('phieudanhgia/home');
  }

   public function create(){
    return view('phieudanhgia/create');
  } 

  public function update(){
    return view('phieudanhgia/update');
  }

  public function view(){
    return view('phieudanhgia/view');
  }


  
}