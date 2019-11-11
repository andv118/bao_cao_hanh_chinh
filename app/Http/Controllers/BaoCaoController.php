<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use Auth;

class BaoCaoController extends Controller
{

  public function baocaotonghop(){
    return view('baocaochung/baocaotonghop');
  }

  public function hoiviendanhdu(){
    return view('baocaochung/hoiviendanhdu');
  }

  public function hoiviennuocngoai(){
    return view('baocaochung/hoiviennuocngoai');
  }
  public function hoivientochuc(){
    return view('baocaochung/hoivientochuc');
  }

  public function tochuccotucachphapnhan(){
    return view('baocaochung/tochuccotucachphapnhan');
  }

  public function tochuccoso(){
    return view('baocaochung/tochuccoso');
  }

  public function nguoinghihuu(){
    return view('baocaochung/nguoinghihuu');
  }

  public function soluongbienche(){
    return view('baocaochung/soluongbienche');
  }

  public function nhiemkydaihoi(){
    return view('baocaochung/nhiemkydaihoi');
  }

  public function cachoidacthu(){
    return view('baocaochung/cachoidacthu');
  }

  public function kinhphihoi(){
    return view('baocaochung/kinhphihoi');
  }

  public function hopdongcachoi(){
    return view('baocaochung/hopdongcachoi');
  }

  public function chiphi(){
    return view('baocaochung/chiphi');
  }

  public function theoloaihoi(){
    return view('baocaochung/theoloaihoi');
  }

  public function linhvuchoi(){
    return view('baocaochung/linhvuchoi');
  }

  public function hoicotochucdang(){
    return view('baocaochung/hoicotochucdang');
  }

  public function phamvihoatdong(){
    return view('baocaochung/phamvihoatdong');
  }

  
}