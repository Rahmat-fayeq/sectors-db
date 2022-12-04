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
              <a href="{{ route('sector.maktob_saved_add') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-3"
                    >
                <i class="md md-add"></i> ثبت کردن معلومات
              </a>   
              <div class="dropdown pull-right">
                <a href="{{ route('sector.maktob_saved_excel') }}" class="btn btn-success m-b-3">
                  <i class="glyphicon glyphicon-download"></i>
                </a> 
              </div>
              <h4 class="header-title m-t-0 m-b-30" style="text-align:center;">مکاتیب حفظیه</h4>
              <table id="datatable" class="table table-bordered  table-hover">
							<thead>
                <tr style="background-color:#435966;">
                  <th style="text-align:center;color:#fff;">شماره</th>
                  <th style="text-align:center;color:#fff;"> نمبر مکتوب</th>
                  <th style="text-align:center;color:#fff;">نمبر کارتن</th>
        				  <th style="text-align:center;color:#fff;">نمبر الماری</th>
        				  <th style="text-align:center;color:#fff;">ردیف الماری</th>
        				  <th style="text-align:center;color:#fff;">سال</th>
                  <th style="text-align:center;color:#fff;">ملاحظات</th>
                  <th style="text-align:center;color:#fff;">فایل</th>
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
        				<td>{{ $data->doc_no }}</td>
                <td>{{ $data->shelf_no	 }}</td>
                <td>{{ $data->shelf_row	 }}</td>
                <td>{{ $data->year	 }}</td>
                <td>{{ $data->remarks }}</td>
                <td>
                  @if(!empty($data->file))
                    <span style="margin-right: 20%;">
                      <a href="{{ route('sector.download', $data->file) }}" class="btn btn-primary">
                      <i class="glyphicon glyphicon-download-alt"></i>
                    </a>
                    </span>
                  @endif  
                </td>
                @if(Auth::user()->role == 'admin')
			        	<td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.maktob_saved_edit',$data->id) }}" class="btn btn-default">
                      <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </span>
                </td>
                <td>
                <span style="margin-right: 7%;">
                        <a onclick="return confirm('آیا مطمئین هستید که حذف شود؟')" href="{{ route('sector.maktob_saved_delete',$data->id) }}" class="btn btn-default">
                        <i class="glyphicon glyphicon-trash" style="color:red"></i>
                      </a>
                 </span>
                </td>
                @endif
                @if(Auth::user()->role == 'head')
			        	<td>
                <span style="margin-right: 7%;">
                      <a href="{{ route('sector.maktob_saved_edit',$data->id) }}" class="btn btn-default">
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

