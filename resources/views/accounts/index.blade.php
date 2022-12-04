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
             <a href="{{ route('accounts.create') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-3"
                    >
                <i class="md md-add"></i> ثبت کردن کاربر
              </a>   
              
              <h4 class="header-title m-t-0 m-b-30" style="text-align:center;">کاربرهای دیتابیس</h4>
              <table id="datatable" class="table table-bordered  table-hover">
				<thead>
                <tr style="background-color:#435966;">
                  <th style="text-align:center;color:#fff;">شماره</th>
                  <th style="text-align:center;color:#fff;">نام کاربر</th>
                  <th style="text-align:center;color:#fff;"> ایمیل</th>
                  <th style="text-align:center;color:#fff;">صلاحیت</th>
                  @if(Auth::user()->role == 'admin')
                    <th style="text-align:center;color:#fff;" >حذف</th>
                  @endif
                </tr>
                </thead>
                <tbody style="text-align:center;">
                <?php $i=1; ?>
              @foreach($info as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->role }}</td>
                @if(Auth::user()->role == 'admin')
                <td>
                <form method="post" action="{{route('accounts.destroy',$data->id)}}">
                    @csrf
                    @method('delete')
                    <span style="margin-right: 7%;">
                        <button onclick="return confirm('آیا مطمئین هستید که حذف شود؟')">
                            <i class="glyphicon glyphicon-trash" style="color:red"></i>
                        </button>
                     </span>
                </form>
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

