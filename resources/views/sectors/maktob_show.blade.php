@extends('layouts.sector_layouts.sector_layout')
@section('content')
<div class="container">
  @if(Session::has('error_message'))  
  <div class="alert alert-danger" rol="alert" style="margin-top: 10px;">
      {{ Session::get('error_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(Session::has('success_message'))  
  <div class="alert alert-success" rol="alert" style="margin-top: 10px;">
      {{ Session::get('success_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ( $errors->all() as $error )
        <li> {{ $error }} </li>
      @endforeach
    </ul>
  </div>
  @endif       
	<div class="row">
      <div class="col-sm-12">
          <div class="card-box table-responsive" style="box-shadow: 1px 2px 12px 12px silver">
          <div class="dropdown pull-right">
                <a href="{{ route('sector.maktob_add') }}" class="btn btn-success btn-md waves-effect waves-light m-b-30"
                   >
                   <i class="md md-add"></i> ثبت کردن معلومات
                </a>
              </div>
              <h4 class="header-title m-t-0 m-b-30" style="text-align:center;"> دریافت گزارش توسط ریاست مربوطه</h4>
              <table id="datatable" class="table table-bordered  table-hover">
							<thead>
              <tr style="background-color:#435966;">
                  <th style="text-align:center;color:#fff;">شماره</th>
                  <th style="text-align:center;color:#fff;"> نمبر مکتوب</th>
                  <th style="text-align:center;color:#fff;">تاریخ مکتوب</th>
        				  <th style="text-align:center;color:#fff;">موضوع</th>
        				  <th style="text-align:center;color:#fff;">ریاست</th>
        				  <th style="text-align:center;color:#fff;">مرجع</th>
                  <th style="text-align:center;color:#fff;">نمبر وارده</th>
                  <th style="text-align:center;color:#fff;">تاریخ وارده</th>
                  <th style="text-align:center;color:#fff;">نوعیت مکتوب</th>
                  <th style="text-align:center;color:#fff;">نوعیت مکتوب</th>
                  @if(Auth::user()->role == 'admin')
                    <th style="text-align:center;color:#fff;" >ویرایش</th>
                    <th style="text-align:center;color:#fff;" >حذف</th>
                  @endif
                  @if(Auth::user()->role == 'head')
                  <th style="text-align:center;color:#fff;" >ویرایش</th>
                  @endif
                </tr>
						</thead>
						<tbody style="text-align:center;">
						<?php $i=1; ?>
              @foreach($info as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $data->maktob_no }}</td>
        				<td>{{ $data->maktob_date }}</td>
                <td>{{ $data->maktob_subject	 }}</td>
                <td>{{ $data->dept}}</td>
                <td>{{ $data->maktob_sender}}</td>
                <td>{{ $data->received_no}}</td>
                <td>{{ $data->received_date}}</td>
                <td>{{ $data->maktob_type}}</td>
                <td>{{ $data->type}}</td>
                @if(Auth::user()->role == 'admin')
                <td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.maktob_edit',$data->id) }}" class="btn btn-default">
                      <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </span>
                </td>
                <td>
                <span style="margin-right: 7%;">
                        <a onclick="return confirm('آیا مطمئین هستید که حذف شود؟')" href="{{ route('sector.maktob_delete',$data->id) }}" class="btn btn-default">
                        <i class="glyphicon glyphicon-trash" style="color:red"></i>
                      </a>
                 </span>
                </td>
                @endif
                @if(Auth::user()->role == 'head')
                <td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.maktob_edit',$data->id) }}" class="btn btn-default">
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

