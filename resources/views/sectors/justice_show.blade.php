@extends('layouts.sector_layouts.sector_layout')
@section('content')

@if(Session::has('error_message'))  
<div class="alert alert-danger" rol="alert" style="margin-top: 10px;color:white;">
    {{ Session::get('error_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has('success_message'))  
<div class="alert alert-success" rol="alert" style="margin-top: 10px;color:white;">
    {{ Session::get('success_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger" style="color:white;">
  <ul>
    @foreach ( $errors->all() as $error )
      <li> {{ $error }} </li>
    @endforeach
  </ul>
</div>
@endif
<div class="container-fluid">
	<div class="row">
      <div class="col-sm-12">
          <div class="card-box table-responsive" style="box-shadow: 1px 2px 12px 12px silver">
            <a href="{{ route('sector.justice_add') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-3"
                  >
              <i class="md md-add"></i> ثبت کردن معلومات
            </a>   
            <div class="dropdown pull-right">
              <a href="{{ route('sector.justice_excel') }}" class="btn btn-success m-b-3">
                <i class="glyphicon glyphicon-download"></i>
              </a> 
            </div>    
          
              <h4 class="header-title m-t-0 m-b-30" style="text-align:center;">قضایای تعقیب عدلی</h4>
              <table id="datatable" class="table table-bordered  table-hover">
							<thead>
                <tr style="background-color:#435966;">
                  <th style="text-align:center;color:#fff;">شماره</th>
                  <th style="text-align:center;color:#fff;">مرجع</th>
                  <th style="text-align:center;color:#fff;">مفتیشین</th>
                  <th style="text-align:center;color:#fff;">موضوع</th>
                  <th style="text-align:center;color:#fff;">پیشنهاد نمبر</th>
                  <th style="text-align:center;color:#fff;">پیشنهاد تاریخ</th>
                  <th style="text-align:center;color:#fff;">نمبر مکتوب کمیته عدلی</th>
                  <th style="text-align:center;color:#fff;">تاریخ مکتوب کمیته عدلی</th>
                  <th style="text-align:center;color:#fff;">مصوبه جلسه</th>
                  <th style="text-align:center;color:#fff;">نمبر مصوبه</th>
                  <th style="text-align:center;color:#fff;">تاریخ مصوبه</th>
                  <th style="text-align:center;color:#fff;">نمبر مکتوب ثارنوال</th>
                  <th style="text-align:center;color:#fff;">تاریخ مکتوب ثارنوال</th>
                  <th style="text-align:center;color:#fff;">ملاحظات</th>
                  <th style="text-align:center;color:#fff;">فایل</th>
                  @if(Auth::user()->role == 'admin')
				          <th style="text-align:center;color:#fff;" >ویرایش</th>
				          <th style="text-align:center;color:#fff;" >حذف</th>
                  @endif
                  @if(Auth::user()->role == 'head')
				          <th style="text-align:center;color:#fff;" >ویرایش</th>h>
                  @endif
                </tr>
						</thead>
						<tbody style="text-align:center;">
						<?php $i=1; ?>
              @foreach($info as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $data->source }}</td>
                <td>{{ $data->auditors}}</td>
                <td>{{ $data->subject }}</td>
                <td>{{ $data->sug_no }}</td>
        				<td>{{ $data->sug_date }}</td>
                <td>{{ $data->board_no	 }}</td>
                <td>{{ $data->board_date	 }}</td>
                <td>{{ $data->result}}</td>
                <td>{{ $data->result_no}}</td>
                <td>{{ $data->result_date}}</td>
                <td>{{ $data->judge_no}}</td>
                <td>{{ $data->judge_date}}</td>
                <td>{{ $data->remarks }}</td>
                <td>
                  @if(!empty($data->file))
                    <span>
                      <a href="{{ route('sector.justice_download', $data->file) }}" class="btn btn-primary">
                      <i class="glyphicon glyphicon-download-alt"></i>
                    </a>
                    </span>
                  @endif  
                </td>
                @if(Auth::user()->role == 'admin')
			        	<td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.justice_edit',$data->id) }}" class="btn btn-default">
                      <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </span>
                </td>
                <td>
                <span style="margin-right: 7%;">
                  <a onclick="return confirm('آیا مطمئین هستید که حذف شود؟')" href="{{ route('sector.justice_delete',$data->id) }}" class="btn btn-default">
                    <i class="glyphicon glyphicon-trash" style="color:red"></i>
                  </a>
                 </span>
                </td>
                @endif
                @if(Auth::user()->role == 'head')
			        	<td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.justice_edit',$data->id) }}" class="btn btn-default">
                      <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </span>
                </td>
                @endif
              </tr>
              @endforeach
						</tbody>
						<tfoot>
					</tfoot>
          </table>
        </div>
     </div><!-- end col -->
  </div> 
</div>

@endsection

