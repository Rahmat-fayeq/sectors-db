@extends('layouts.sector_layouts.sector_layout')
@section('content')

<div class="row">
  <div class="panel">
    <div class="col-sm-12">
        <h4 class="page-title" style="text-align:center;">ارتباط با ما</h4>
    </div>
<!-- end row -->
      <div class="panel-body ">
          <div class="row text-center">
                  <div class="col-md-10  padding0"  id="book">
                    <div class="thumbnail">
                      <div class="card product_admin" >
                          <div style="min-height:40px;font-size:35px ;background-color: #eeeedd;" class="align_center">
                              <a href="#" style="font-size:20px; color:#6e0068;"><b>Information Technolgy Department</b></a>
                          </div>
                          <div class="card-body">
                              <div class="col-md-6" style="margin-top:40px;">
                                <div class="card-text table-responsive" style="">
                                    <table class="table " >
                                        <tr><th style="padding-right:50px; color:#ee2a7c;">شماره تماس</th><td>0799225732</td></tr>
                                        <tr><th style="padding-right:50px; color:#ee2a7c;">ایمیل آدرس</th><td>fayeq.rahmat@mail.com</td></tr>
                                        <tr><th style="padding-right:50px; color:#ee2a7c;">آدرس</th><td>کابل|  دارالمان</td></tr>
                                        <tr><th style="padding-right:50px; color:#ee2a7c;">لینک فسبوک</th><td><a target="_blank" href="https://facebook.com/SaeediRahmat">Facebook</a></td></tr>
                                        <tr><th style="padding-right:50px; color:#ee2a7c;">لینک ویبسایت</th><td><a target="_blank" href="https://rahmat.vercel.app">Website</a></td></tr>

                                    </table>
                                </div>
                              </div>
                                <div class="col-md-6" style="margin-top:20px;">
                                  <img src="{{ asset('assets/imgs/background/supreme_logo.jpg') }}" style="width:478px; height:300px;" class="product-img img-thumbnail img-responsive"  alt="" title="" />
                                </div>
                          </div>
                      </div>

                  </div>
                </div>
          </div>
      </div>
</div>

@endsection
