<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TieuChi;
use App\Models\DanhMuc;
use App\Models\Users;
use App\Models\QuanHuyen;
use App\Models\SoBanNganh;
use App\Models\JoinQHTC;
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

  
  
  public function ThemMoiTieuChi(){
    
    $data2 = TieuChi::all();
    $DanhMuc = DanhMuc::all();
    $QuanHuyen = QuanHuyen::all();

    return view('danhmuchethong/ThemMoiTieuChi',compact('data2','DanhMuc','QuanHuyen'));
  }

  public function LuuTieuChi(Request $request){
    $data = new TieuChi();
    $data2 = TieuChi::all();
    $DanhMuc = DanhMuc::all();
    $JoinQHTC = JoinQHTC::all();

    
    $data->TieuChi = $request->TenTieuChi;
    if ($request->SoLuong != '') {
      $data->SoLuong = $request->SoLuong;
    }

    if ($request->DonViTinh != '') {
      $data->DonViTinh = $request->DonViTinh;
    }
    
    if ($request->GiaiTrinh != '') {
      $data->GiaiTrinh = $request->GiaiTrinh;
    }
    
    if ($request->TieuChiCha != '') {
      $data->TieuChiCha = $request->TieuChiCha;
    }
    
    if ($request->DanhMuc != '') {
      $data->DanhMuc = $request->DanhMuc;
    }

    if ($request->QuanHuyen != '') {
      $JoinQHTC->id_quan_huyen = $request->QuanHuyen;
    }
    
    $data->save();

    $id = $data->id;    

    if ($request->QuanHuyen != '') {
      $JoinQHTC->id_tieu_chi = $id;
    }
    
    return redirect()->back()->with('success','Thêm mới thành công');
    
  }

  public function DanhMucTieuChi(){
    $data = DanhMuc::all();
    return view('danhmuchethong/DanhMucTieuChi',compact('data'));
  }

  public function DanhSachTieuChi(){
    $data = TieuChi::all();
    $DanhMuc = DanhMuc::all();
    $JoinQHTC = JoinQHTC::all();
    return view('danhmuchethong/DanhSachTieuChi',compact('data','DanhMuc','JoinQHTC'));
  }

  public function SuaTieuChi($id){
    
    $data = TieuChi::where('id',$id)->get()->toArray();
    $data2 = TieuChi::all();
    $DanhMuc = DanhMuc::all();
    $QuanHuyen = QuanHuyen::all();
    $JoinQHTC = JoinQHTC::all();
    
    return view('danhmuchethong/SuaTieuChi',compact('data','data2','DanhMuc','QuanHuyen','JoinQHTC'));
  }

  public function UpdateTieuChi(Request $request){
    $id = $request->id;
    $SoLuong = null;
    $DonViTinh = null;
    $GiaiTrinh = null;
    $TieuChiCha = null;
    $DanhMuc = null;
    $QuanHuyen = null;
    $data = TieuChi::where('id',$id);
    $JoinQHTC = JoinQHTC::where('id_tieu_chi',$id);

    $TieuChi = $request->TenTieuChi;

    if ($request->SoLuong != '') {
      $SoLuong=$request->SoLuong;
    }

    if ($request->DonViTinh != '') {
      $DonViTinh=$request->DonViTinh;
    }

    if ($request->GiaiTrinh != '') {
      $GiaiTrinh=$request->GiaiTrinh;
    }

    if ($request->TieuChiCha != '') {
      $TieuChiCha=$request->TieuChiCha;
    }

    if ($request->DanhMuc != '') {
      $DanhMuc=$request->DanhMuc;
    }

    if ($request->QuanHuyen != '') {
      $QuanHuyen=$request->QuanHuyen;
    }

    $data->update(['TieuChi'=>$TieuChi,'SoLuong'=>$SoLuong,'DonViTinh'=>$DonViTinh,'GiaiTrinh'=>$GiaiTrinh,'TieuChiCha'=>$TieuChiCha,'DanhMuc'=>$DanhMuc]);

    $JoinQHTC->update(['id_quan_huyen'=>$QuanHuyen]);

    return redirect()->back()->with('success','Sửa thành công !');
  }

  public function XoaTieuChi($id){
  
    $data = TieuChi::where('id',$id)->delete();
    $JoinQHTC = JoinQHTC::where('id_tieu_chi',$id)->delete();
    
    return redirect()->back()->with('delete','Xóa thành công!!!');
  }

  public function ThemDanhMuc(Request $request){
  
    $data = new DanhMuc();

    $data->DanhMuc = $request->TenDanhMuc;
    if ($request->DanhMucCha != '') {
      $data->DanhMucCha = $request->DanhMucCha;
    }
    $data->save();
    
    return redirect()->back()->with('success','Thêm mới thành công!!!');
  }

  public function SuaDanhMucTieuChi($id){
  
    $data = DanhMuc::where('id',$id)->get()->toArray();
    $data2 = DanhMuc::all();
    
    
    return view('danhmuchethong/SuaDanhMucTieuChi',compact('data','data2'));
  }

  public function PostSuaDanhMucTieuChi(Request $request){
    $id = $request->id;
    $data = DanhMuc::where('id',$id);
    $DanhMuc=null;
    $DanhMucCha=null;
    if ($request->TenDanhMuc != '') {
      $DanhMuc = $request->TenDanhMuc;
    }

    if ($request->DanhMucCha != '') {
      $DanhMucCha = $request->DanhMucCha;
    }

    $data->update(['DanhMuc'=>$DanhMuc,'DanhMucCha'=>$DanhMucCha]);
    
    
    return redirect()->back()->with('success','Sửa thành công !');
  }

  public function ThemMoiDanhMucHanhChinh(){
    return view('danhmuchethong/ThemMoiDanhMucHanhChinh');
  }

  public function danhMucHanhChinh(){
    if (Auth::check()) {
      $id_So_Ban_Nganh = Auth::user()->id_So_Ban_Nganh;
    }
    $SoBanNganh = SoBanNganh::where('id',$id_So_Ban_Nganh)->get()->toArray();
    $QH = QuanHuyen::all();
    return view('danhmuchethong/danhmuchanhchinh',compact('SoBanNganh','QH'));
  }

  public function ChiTietDanhMucHanhChinh($id){
    
    if (Auth::check()) {
      $id_So_Ban_Nganh = Auth::user()->id_So_Ban_Nganh;
    }
    $join = JoinQHTC::where('id_quan_huyen',$id)->get();

    $data = TieuChi::where('id_So_Ban_Nganh',$id_So_Ban_Nganh)->get();

    $TieuChi= TieuChi::all();
    $SoBanNganh = SoBanNganh::where('id',$id_So_Ban_Nganh)->get()->toArray();
    $QH = QuanHuyen::where('id',$id)->get()->toArray();
    $DanhMuc = DanhMuc::all();

    return view('danhmuchethong/ChiTietDanhMucHanhChinh',compact('SoBanNganh','QH','join','data','DanhMuc','TieuChi'));
  }

  public function SuaDanhMucHanhChinh(){
    return view('danhmuchethong/SuaDanhMucHanhChinh');
  }
}
