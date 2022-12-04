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
             <a href="{{ route('sector.auditor_add') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-3"
                    >
                <i class="md md-add"></i> ثبت کردن معلومات
              </a>   
              <div class="dropdown pull-right">
                <a href="{{ route('sector.auditor_excel') }}" class="btn btn-success m-b-3">
                  <i class="glyphicon glyphicon-download"></i>
                </a> 
              </div>
              
              <h4 class="header-title m-t-0 m-b-30" style="text-align:center;">مفتیش</h4>
              <table id="datatable" class="table table-bordered  table-hover">
							<thead>
                <tr style="background-color:#435966;">
                  <th style="text-align:center;color:#fff;">شماره</th>
                  <th style="text-align:center;color:#fff;"> نام مکمل</th>
                  <th style="text-align:center;color:#fff;">نام پدر</th>
                  <th style="text-align:center;color:#fff;">عنوان بست</th>
                  <th style="text-align:center;color:#fff;">درجه بست</th>
                  <th style="text-align:center;color:#fff;">ایمیل</th>
                  <th style="text-align:center;color:#fff;">نمبرتماس</th>
                  <th style="text-align:center;color:#fff;">نمبرواتسپ</th>
                  <th style="text-align:center;color:#fff;">ریاست</th>
                  <th style="text-align:center;color:#fff;">ملاحظات</th>
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
                <td>{{ $data->name }}</td>
                <td>{{ $data->fname }}</td>
                <td>{{ $data->job }}</td>
                <td>{{ $data->rank }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->whatsapp }}</td>
                <td>{{ $data->departments['department'] }}</td>
        				<td>{{ $data->remarks }}</td>
                @if(Auth::user()->role == 'admin')
			        	<td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.auditor_edit',$data->id) }}" class="btn btn-default">
                      <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </span>
                </td>
                <td>
                <span style="margin-right: 7%;">
                  <a onclick="return confirm('آیا مطمئین هستید که حذف شود؟')" href="{{ route('sector.auditor_delete',$data->id) }}" class="btn btn-default">
                    <i class="glyphicon glyphicon-trash" style="color:red"></i>
                  </a>
                 </span>
                </td>
                @endif
                @if(Auth::user()->role == 'head')
			        	<td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.auditor_edit',$data->id) }}" class="btn btn-default">
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

