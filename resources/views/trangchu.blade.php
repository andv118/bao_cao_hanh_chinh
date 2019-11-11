@extends('master')

@section('content')
<style type="text/css">
  
  .count_top {
    font-weight: bold;
  }
</style>

 <?php 
 $internet = @fsockopen('www.google.com',80);
 if($internet){  ?>

 <img src="http://banners.wunderground.com/banner/gizmotimetemp_both/ 
language/www/global/stations/48820.gif" alt="Du bao thoi tiet - Thu do Ha Noi" title="Dự báo thời tiết - Thủ đô Hà Nội" height="41" width="127">
<?php } ?>
       <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Tổng số hội</span>
              <div class="count">{{number_format($total)}}</div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Số hội hoàn tất thông tin dưới 10%</span>
              <div class="count">275</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>  Số hội hoàn tất thông tin dưới 20%</span>
              <div class="count">321</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>  Số hội hoàn tất thông tin dưới 30%</span>
              <div class="count">214</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>  Số hội hoàn tất thông tin dưới 40%</span>
              <div class="count">98</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>  Số hội hoàn tất thông tin 100%</span>
              <div class="count">2,192</div>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Biểu đồ</h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          
 <?php 
 $internet = @fsockopen('www.google.com',80);
 if($internet){  
  ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12" >

    <div class="col-md-6">
          <h3>Bản đồ  <small>Thành Phố Hà Nội</small></h3>
        </div>
    
    <iframe style="border:1px solid grey;border-radius: 8px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.316200686121!2d105.8560895142977!3d21.020030393453556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abee7688cb9f%3A0xa4165e30161278bd!2zU-G7nyBO4buZaSB24bulIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1570603897213!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </div>
</div>
 <?php } ?>


@endsection