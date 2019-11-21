<?php
// Route::get('/', 'BaseController@userview')->name('userview');
Route::get('/', function() {
       return redirect('login');
});
Route::get('thong-tin-chi-tiet-hoi/{MaHoi}', 'InfoController@thongTinChiTietHoi')->name('thong-tin-chi-tiet-hoi');
Route::post('tim-kiem-hoi', 'BaseController@AjaxSearch')->name('AjaxSearch');
Route::get('login', 'UserController@getLogin')->name('loginn')->middleware('checkLogout');
Route::post('login', 'UserController@login')->name('login');
Route::get('dang-xuat', ['as' => 'logout', 'uses' => 'UserController@logout']);
Route::get('sendmail', ['as' => 'sendmail', 'uses' => 'BaseController@sendmail']);
Route::get('/khao-sat', ['as' => 'khaosat', 'uses' => 'UserController@khaosat']);

Route::group(['prefix' => '/danh-muc', 'as' => 'admin.', 'middleware' => ['checkLogin']], function () {
       Route::get('trang-chu', 'BaseController@home')->name('home');

       /******************************* Người dùng ****************************/
       Route::group(['prefix' => '/account', 'as' => 'account.'], function () { 
              /*********** Nhóm người dùng *********/
              Route::get('quan-ly-nhom-nguoi-dung', 'AccountController@getAllGroupAccount')->name('manageGroupAccount')->middleware('CheckAdmin');
              Route::get('them-nhom-nguoi-dung', 'AccountController@createGroupUsers')->name('createGroupUsers')->middleware('CheckAdmin');
              Route::post('dang-ky-nhom-nguoi-dung', 'AccountController@registerGroupUser')->name('registerGroupUser')->middleware('CheckAdmin');
              Route::post('cap-nhat-nhom-nguoi-dung', 'AccountController@updateGroupUser')->name('updateGroupUser')->middleware('CheckAdmin');
              Route::post('xoa-nhom-nguoi-dung', 'AccountController@deleteGroupUser')->name('deleteGroupUser')->middleware('CheckAdmin');

              /*********** Người dùng *********/
              Route::get('quan-ly-nguoi-dung', 'AccountController@getAllAccount')->name('manageAccount')->middleware('CheckAdmin');
              Route::get('them-nguoi-dung', 'AccountController@createUsers')->name('createUsers')->middleware('CheckAdmin');
              Route::post('dang-ky-nguoi-dung', 'AccountController@registerUsers')->name('registerUsers')->middleware('CheckAdmin');
              Route::post('cap-nhat-nguoi-dung', 'AccountController@updateUser')->name('updateUser')->middleware('CheckAdmin');
              Route::post('xoa-nguoi-dung', 'AccountController@deleteUser')->name('deleteUser')->middleware('CheckAdmin');
              Route::post('xuat-excel-nguoi-dung', 'AccountController@exportUser')->name('exportUsers')->middleware('CheckAdmin');

       });

       /******************************* Mẫu báo cáo ****************************/
       Route::group(['prefix' => '/mau-bao-cao', 'middleware' => ['CheckAdmin']], function () {
              Route::get('/', 'ReportController@getModelReport')->name('modelReport');
              Route::get('chi-tiet-mau-bao-cao/{maMauBaoCao}', 'ReportController@getDetailModelReport')->name('detailModelReport');
              Route::get('them-mau-bao-cao', 'ReportController@createModelReport')->name('createModelReport');
       });

       // Route::get('danh-sach-tai-khoan', 'BaseController@users')->name('users')->middleware('CheckAdmin');
       Route::get('them-tai-khoan', 'BaseController@create_users')->name('create_users')->middleware('CheckAdmin');
       Route::post('tao-tai-khoan', ['as' => 'register', 'uses' => 'BaseController@register'])->middleware('CheckAdmin');
       Route::post('tim-kiem-tai-khoan', ['as' => 'SearchUser', 'uses' => 'UserController@SearchUser']);
       Route::post('xoa-tai-khoan', ['as' => 'DeleteUser', 'uses' => 'UserController@DeleteUser'])->middleware('CheckAdmin');
       Route::post('doi-mat-khau', ['as' => 'changePass', 'uses' => 'UserController@changePass']);
       Route::post('cap-nhat-thong-tin-ca-nhan', ['as' => 'updateProfile', 'uses' => 'UserController@updateProfile']);
       Route::post('cap-nhat-tai-khoan', ['as' => 'update_account', 'uses' => 'UserController@update_account'])->middleware('CheckAdmin');
       Route::get('xuat-danh-sach-can-bo', ['as' => 'export_users', 'uses' => 'PhonebookController@export_users'])->middleware('CheckAdmin');
       Route::post('xuat-ket-qua-tim-kiem-can-bo', ['as' => 'export_search_users', 'uses' => 'PhonebookController@export_search_users']);


       Route::get('list', 'InfoController@list_info')->name('list-info');
       Route::post('list_search', 'InfoController@post_search_list')->name('ajax-search');

       Route::get('info/detail/{id}', 'InfoController@detail_info')->name('detail-info');

       Route::get('info/edit/{id}', 'InfoController@get_info')->name('edit-info');
       Route::post('edit/{id}', 'InfoController@search_info');

       Route::get('home', 'InfoController@create')->name('home_info');
       Route::post('home/save1', 'InfoController@save')->name('saveInfo');
       Route::post('home/save2', 'InfoController@saveRename')->name('saveRename');
       Route::post('home/save3', 'InfoController@saveJoining')->name('saveJoining');
       Route::post('home/save4', 'InfoController@saveFacility')->name('saveFacility');
       Route::post('home/save5', ['as' => 'saveDissolution', 'InfoController@saveDissolution'])->name('saveDissolution');
       Route::post('home/save5', 'InfoController@saveExpense')->name('saveExpense');
       Route::post('home/save5', 'InfoController@saveTotalCost')->name('saveTotalCost');

       Route::get('info/list-member', 'InfoController@listMember')->name('list-member');
       Route::get('info/list-type', 'InfoController@listType')->name('list-type');

       Route::get('ajaxRequest', 'InfoController@ajaxRequest')->name('ajaxRequest');

       Route::post('ajaxRequest', 'InfoController@ajaxRequestPost');

       Route::get('ajaxRename', 'InfoController@ajaxRename');
       Route::post('ajaxRename', 'InfoController@ajaxRenamePost')->name('ajaxRename');

       // Quản lý thông tin hội 
       Route::group(['prefix' => 'quan-ly-thong-tin-hoi'], function () {
              Route::get('nhap-thong-tin-hoi', 'InfoController@create')->name('themHoi');
              Route::post('luu-thong-tin-hoi', 'InfoController@saveInfo')->name('luuHoi');
       });

       //Danh mục hệ thống
       Route::group(['prefix' => '/danh-muc-he-thong'], function () {
              Route::get('danh-muc-co-quan', 'DanhmucController@danhmuccoquan')->name('danhmuccoquan');
              Route::get('danh-muc-linh-vuc', 'DanhmucController@danhmuclinhvuc')->name('danhmuclinhvuc');
              Route::get('danh-muc-quan-huyen', 'DanhmucController@danhmucquanhuyen')->name('danhmucquanhuyen');
              Route::get('danh-muc-xa-phuong', 'DanhmucController@danhmucxaphuong')->name('danhmucxaphuong');
              Route::get('cau-hinh-he-thong', 'DanhmucController@cauhinh')->name('cauhinh');
       });
       //Thống kê pháp nhân
       Route::group(['prefix' => '/thong-ke-phap-nhan'], function () {

              Route::get('thuoc-so-nganh', 'ThongKeController@hoithuocsonganh')->name('thuocsonganh');
              Route::get('thuoc-quan-huyen', 'ThongKeController@hoithuocquanhuyen')->name('thuocquanhuyen');
       });
       //Báo cáo chung
       Route::group(['prefix' => '/bao-cao-chung'], function () {

              Route::get('bao-cao-tong-hop', 'BaoCaoController@baocaotonghop')->name('baocaotonghop');
              Route::get('hoi-vien-danh-du', 'BaoCaoController@hoiviendanhdu')->name('hoiviendanhdu');
              Route::get('hoi-vien-nuoc-ngoai', 'BaoCaoController@hoiviennuocngoai')->name('hoiviennuocngoai');
              Route::get('hoi-vien-to-chuc', 'BaoCaoController@hoivientochuc')->name('hoivientochuc');
              Route::get('to-chuc-co-tu-cach-phap-nhan', 'BaoCaoController@tochuccotucachphapnhan')->name('tochuccotucachphapnhan');
              Route::get('to-chuc-co-so', 'BaoCaoController@tochuccoso')->name('tochuccoso');
              Route::get('nguoi-nghi-huu', 'BaoCaoController@nguoinghihuu')->name('nguoinghihuu');
              Route::get('so-luong-bien-che', 'BaoCaoController@soluongbienche')->name('soluongbienche');
              Route::get('nhiem-ky-dai-hoi', 'BaoCaoController@nhiemkydaihoi')->name('nhiemkydaihoi');
              Route::get('cac-hoi-dac-thu', 'BaoCaoController@cachoidacthu')->name('cachoidacthu');
              Route::get('kinh-phi-hoi', 'BaoCaoController@kinhphihoi')->name('kinhphihoi');
              Route::get('hop-dong-cac-hoi', 'BaoCaoController@hopdongcachoi')->name('hopdongcachoi');
              Route::get('chi-phi', 'BaoCaoController@chiphi')->name('chiphi');
              Route::get('the-loai-hoi', 'BaoCaoController@theoloaihoi')->name('theoloaihoi');
              Route::get('linh-vuc-hoi', 'BaoCaoController@linhvuchoi')->name('linhvuchoi');
              Route::get('hoi-co-to-chuc-dang', 'BaoCaoController@hoicotochucdang')->name('hoicotochucdang');
              Route::get('pham-vi-hoat-dong', 'BaoCaoController@phamvihoatdong')->name('phamvihoatdong');
       });

       //Thống kê theo trụ sở hoạt động
       Route::group(['prefix' => 'thong-ke-tru-so-hoat-dong'], function () {
              Route::get('thong-ke-tru-so-do-nha-nuoc-cap', 'ThongketrusoController@nhanuoc')->name('thongke.nhanuoc');
              Route::get('thong-ke-tru-so-hoi-tu-tuc', 'ThongketrusoController@tutuc')->name('thongke.tutuc');
       });

       //Thống kê theo người đứng đầu
       Route::group(['prefix' => 'thong-ke-tru-so-theo-nguoi-dung-dau'], function () {
              Route::get('thong-ke-lanh-dao-kiem-nghiem', 'ThongkedungdauController@kiemnghiem')->name('thongke.kiemnghiem');
              Route::get('thong-ke-lanh-dao-theo-gioi-tinh', 'ThongkedungdauController@gioitinh')->name('thongke.gioitinh');
              Route::get('thong-ke-theo-tuoi-lanh-dao', 'ThongkedungdauController@tuoi')->name('thongke.tuoi');
       });

       //Quản lý câu hỏi đánh giá hội
       Route::group(['prefix' => 'quan-ly-cau-hoi-danh-gia-hoi'], function () {
              Route::get('home', 'CauhoidanhgiaController@cauhoidanhgia')->name('quanlycauhoi.cauhoidanhgia');
       });

       //Quản lý phiếu đánh giá hội
       Route::group(['prefix' => 'quan-ly-phieu-danh-gia-hoi'], function () {
              Route::get('home', 'PhieudanhgiaController@phieudanhgia')->name('quanlyphieu.phieudanhgia');
              Route::get('create', 'PhieudanhgiaController@create')->name('quanlyphieu.create');
              Route::get('update', 'PhieudanhgiaController@update')->name('quanlyphieu.update');
              Route::get('view', 'PhieudanhgiaController@view')->name('quanlyphieu.view');
       });



       Route::get('them-danh-ba', 'BaseController@create_phonebook')->name('create_phonebook');
       Route::post('them-danh-ba', ['as' => 'save_phonebook', 'uses' => 'PhonebookController@save_phonebook']);
       Route::get('cap-nhat-danh-ba/{id}', 'PhonebookController@edit_phonebook')->name('edit_phonebook')->middleware('CheckAdmin');
       Route::post('cap-nhat-danh-ba', ['as' => 'update_phonebook', 'uses' => 'PhonebookController@update_phonebook'])->middleware('CheckAdmin');
       Route::post('check_taxcode', ['as' => 'check_taxcode', 'uses' => 'PhonebookController@check_taxcode']);
       Route::post('get_fullname', ['as' => 'get_fullname', 'uses' => 'PhonebookController@get_fullname']);
       Route::get('quan-ly-danh-ba', 'BaseController@detail_phonebook')->name('detail_phonebook')->middleware('CheckAdmin');
       Route::get('quan-ly-danh-ba', 'BaseController@detail_phonebook')->name('detail_phonebook')->middleware('CheckAdmin');
       Route::get('xoa-danh-ba/{id}', 'BaseController@delete_phonebook')->name('delete_phonebook')->middleware('CheckAdmin');
       Route::get('xuat-danh-ba', 'PhonebookController@export_phonebook')->name('export_phonebook');
       Route::get('xuat-file-nhap-danh-ba', 'PhonebookController@export_excel_phonebook')->name('export_excel_phonebook');
       Route::post('xuat-ket-qua-tim-kiem-danh-ba', 'PhonebookController@export_search_phonebook')->name('export_search_phonebook');
       Route::post('tim-kiem-danh-ba', 'PhonebookController@search_phonebook')->name('search_phonebook');


       Route::get('them-tai-san', 'BaseController@create_property')->name('create_property');
       Route::post('luu-tai-san', 'BaseController@save_property')->name('save_property');
       Route::get('quan-ly-tai-san', 'BaseController@detail_property')->name('detail_property')->middleware('CheckAdmin');
       Route::get('cap-nhat-tai-san/{id}', 'BaseController@update_property')->name('update_property')->middleware('CheckAdmin');
       Route::post('cap-nhat-tai-san', 'BaseController@change_property')->name('change_property')->middleware('CheckAdmin');
       Route::get('xoa-tai-san/{id}', 'BaseController@delete_property')->name('delete_property')->middleware('CheckAdmin');
       Route::get('xuat-tai-san', 'PropertyController@export_property')->name('export_property')->middleware('CheckAdmin');
       Route::post('tim-kiem-tai-san', 'PropertyController@search_property')->name('search_property')->middleware('CheckAdmin');
       Route::post('xuat-ket-qua-tim-kiem-tai-san', 'PropertyController@export_search_property')->name('export_search_property');
       Route::post('getAllProperty', 'PropertyController@getProperty')->name('getProperty');
       Route::post('getNameByTaxcode', 'PropertyController@getNameByTaxcode')->name('getNameByTaxcode');
       Route::post('getPropertyById', 'PropertyController@getPropertyById')->name('getPropertyById');
       Route::get('ke-khai-tai-san/{id}', 'PropertyController@declare_property')->name('declare_property')->middleware('CheckAdmin');


       Route::get('them-hop-dong', 'BaseController@create_contract')->name('create_contract')->middleware('checkLogout');
       Route::get('quan-ly-hop-dong', 'BaseController@detail_contract')->name('detail_contract')->middleware('CheckAdmin');
       Route::post('save_contract', ['as' => 'save_contract', 'uses' => 'BaseController@save_contract']);
       Route::post('check_property', ['as' => 'check_property', 'uses' => 'BaseController@check_property']);
       Route::get('cap-nhat-hop-dong/{id}', 'BaseController@update_contract')->name('update_contract')->middleware('CheckAdmin');
       Route::post('cap-nhat-hop-dong', 'BaseController@change_contract')->name('change_contract')->middleware('CheckAdmin');
       Route::post('tim-kiem-hop-dong', 'ContractController@search_contract')->name('search_contract');
       Route::get('ke-khai-hop-dong/{id}', 'BaseController@declare_contract')->name('declare_contract')->middleware('CheckAdmin');
       Route::get('xuat-hop-dong', 'ContractController@export_contract')->name('export_contract');
       Route::post('xuat-ket-qua-tim-kiem-hop-dong', 'ContractController@export_search_contract')->name('export_search_contract');
       Route::post('xoa-file-dinh-kem-hop-dong', 'ContractController@delete_file')->name('delete_file');


       Route::get('them-to-khai', 'TaxController@create_tax')->name('create_tax');
       Route::get('nop-thue', 'TaxController@get_money')->name('get_money');
       Route::post('ky-ke-khai', 'TaxController@get_declare')->name('get_declare');
       Route::post('luu-to-khai', 'TaxController@save_tax')->name('save_tax');
       Route::post('luu-ke-khai', 'TaxController@save_tax_declare')->name('save_tax_declare');
       Route::post('xoa-to-khai', 'TaxController@delete_tax_declare')->name('delete_tax_declare');
       Route::post('kiem-tra-ma-hop-dong', 'TaxController@check_contractcode')->name('check_contractcode');
       Route::get('lay-ma-hop-dong', 'TaxController@get_contractcode')->name('get_contractcode');
       Route::post('lay-ten-chu-nha', 'TaxController@get_fullname_contract')->name('get_fullname_contract');
       Route::post('lay-ma-so-thue', 'TaxController@get_taxcode_contract')->name('get_taxcode_contract');
       Route::post('lay-ma-tai-san', 'TaxController@get_propertycode_contract')->name('get_propertycode_contract');
       Route::post('get-taxcode', 'TaxController@getTaxcode')->name('getTaxcode');
       Route::get('quan-ly-thue', 'TaxController@detail_tax')->name('detail_tax')->middleware('CheckAdmin');
       Route::get('xuat-du-lieu-thue', 'TaxController@export_tax')->name('export_tax')->middleware('CheckAdmin');
       Route::post('tim-kiem-thue', 'TaxController@search_tax')->name('search_tax');
       Route::get('cap-nhat-thue/{id}', 'TaxController@update_tax')->name('update_tax')->middleware('CheckAdmin');
       Route::post('cap-nhat-thue', 'TaxController@change_tax')->name('change_tax')->middleware('CheckAdmin');
       Route::post('xuat-ket-qua-tim-kiem-thue', 'TaxController@export_search_tax')->name('export_search_tax')->middleware('CheckAdmin');


       Route::get('quan-ly-rui-ro', 'ErrorController@manage_error')->name('manage_error')->middleware('CheckAdmin');
       Route::get('quan-ly-rui-ro-5', 'ErrorController@error5')->name('error5')->middleware('CheckAdmin');
       Route::get('quan-ly-rui-ro-4', 'ErrorController@error4')->name('error4')->middleware('CheckAdmin');
       Route::get('quan-ly-rui-ro-3', 'ErrorController@error3')->name('error3')->middleware('CheckAdmin');
       Route::get('quan-ly-rui-ro-2', 'ErrorController@error2')->name('error2')->middleware('CheckAdmin');
       Route::get('quan-ly-rui-ro-1', 'ErrorController@error1')->name('error1')->middleware('CheckAdmin');

       //Xuất báo cáo excel-------------------------------------------------------------------
       Route::get('xuat-bao-cao-rui-ro-5', 'ErrorController@export_error5')->name('export_error5');
       Route::get('xuat-bao-cao-rui-ro-4', 'ErrorController@export_error4')->name('export_error4');
       Route::get('xuat-bao-cao-rui-ro-3', 'ErrorController@export_error3')->name('export_error3');
       Route::get('xuat-bao-cao-rui-ro-2', 'ErrorController@export_error2')->name('export_error2');
       Route::get('xuat-bao-cao-rui-ro-1', 'ErrorController@export_error1')->name('export_error1');
       Route::get('xuat-bao-cao-ghi-thu', 'ReportController@export_record')->name('export_record');
       Route::get('xuat-bao-cao-du-kien', 'ReportController@export_submit')->name('export_submit');
       Route::get('xuat-bao-cao-rui-ro', 'ReportController@export_error')->name('export_error');
       Route::get('xuat-bao-cao-don-doc-ke-khai', 'ReportController@export_force')->name('export_force');
       Route::get('xuat-bao-cao-hop-dong-ke-khai-dung-han', 'ReportController@export_declare_ontime')->name('export_declare_ontime');
       Route::get('xuat-bao-cao-hop-dong-ke-khai-qua-han', 'ReportController@export_declare_outtime')->name('export_declare_outtime');
       Route::get('xuat-bao-cao-hop-dong-phai-nop-thue', 'ReportController@export_declare')->name('export_declare');
       Route::get('xuat-bao-cao-hop-dong-da-nop-thue', 'ReportController@export_declared')->name('export_declared');
       Route::get('xuat-bao-cao-hop-dong-nop-thue-dung-han', 'ReportController@export_submit_ontime')->name('export_submit_ontime');
       Route::get('xuat-bao-cao-hop-dong-nop-thue-qua-han', 'ReportController@export_submit_outtime')->name('export_submit_outtime');
       Route::get('xuat-bao-cao-hop-dong-co-ky-khai-thue-can-nop', 'ReportController@export_period')->name('export_period');
       Route::get('xuat-bao-cao-hop-dong-con-no-thue', 'ReportController@export_tax_debt')->name('export_tax_debt');


       Route::get('bao-cao-tong-hop', 'ReportController@report_total')->name('report_total')->middleware('CheckAdmin');
       Route::get('bao-cao-ghi-thu', 'ReportController@report_record')->name('report_record')->middleware('CheckAdmin');
       Route::get('bao-cao-phai-nop', 'ReportController@report_submit')->name('report_submit')->middleware('CheckAdmin');
       Route::get('bao-cao-rui-ro', 'ReportController@report_error')->name('report_error')->middleware('CheckAdmin');
       Route::get('bao-cao-ke-khai', 'ReportController@report_force')->name('report_force')->middleware('CheckAdmin');
       Route::get('bao-cao-ke-khai-dung-han', 'ReportController@declare_ontime')->name('declare_ontime')->middleware('CheckAdmin');
       Route::get('bao-cao-ke-khai-qua-han', 'ReportController@declare_outtime')->name('declare_outtime')->middleware('CheckAdmin');
       Route::get('hop-dong-phai-nop-thue', 'ReportController@declare')->name('declare')->middleware('CheckAdmin');
       Route::get('hop-dong-da-nop-thue', 'ReportController@declared')->name('declared')->middleware('CheckAdmin');
       Route::get('hop-dong-da-nop-thue-dung-han', 'ReportController@submit_ontime')->name('submit_ontime')->middleware('CheckAdmin');
       Route::get('hop-dong-da-nop-thue-qua-han', 'ReportController@submit_outtime')->name('submit_outtime')->middleware('CheckAdmin');
       Route::get('hop-dong-co-ky-thue-can-nop', 'ReportController@period')->name('period')->middleware('CheckAdmin');
       Route::get('hop-dong-co-no-thue', 'ReportController@tax_debt')->name('tax_debt')->middleware('CheckAdmin');

       Route::get('quan-ly-cau-hinh', 'BaseController@config')->name('config')->middleware('CheckAdmin');
       Route::get('nhat-ky-hoat-dong', 'BaseController@history')->name('history')->middleware('CheckAdmin');
       Route::get('thong-tin-tai-khoan', 'BaseController@profile')->name('profile');


       Route::post('get-street', 'BaseController@get_street')->name('get_street');
       Route::post('get-location', 'BaseController@get_location')->name('get_location');
       Route::post('get-houseprice', 'BaseController@get_houseprice')->name('get_houseprice');
       Route::post('them-gia-dat', 'BaseController@insert_landcost')->name('insert_landcost');
       Route::post('them-gia-nha', 'BaseController@insert_houseprice')->name('insert_houseprice');
       Route::post('them-don-vi-tien', 'BaseController@insert_currency')->name('insert_currency');
       Route::post('cap-nhat-gia-dat', 'BaseController@update_landcost')->name('update_landcost');
       Route::post('cap-nhat-gia-nha', 'BaseController@update_pricehouse')->name('update_pricehouse');
       Route::post('cap-nhat-ty-gia', 'BaseController@update_currency')->name('update_currency');
       Route::post('cap-nhat-lai-suat', 'BaseController@update_interest')->name('update_interest');
       Route::post('cap-nhat-chu-ky', 'BaseController@update_signature')->name('update_signature');
       Route::post('nhap-file-danh-ba', 'PhonebookController@import_phonebook')->name('import_phonebook');
});
