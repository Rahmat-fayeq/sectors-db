@extends('layouts.sector_layouts.sector_layout')
 @section('content')
<!DOCTYPE html>
<html>
<head>
  <link href="{{ asset('public/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" media="all">

  <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>

</head>
<body>
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
<div class="container" style="background-color: skyblue;border-radius: 10px;color:white; width:80%">
  <h2 style="color:white;"><center>تغیر رمز عبور</center></h2>
   <div class="col-xs-4" style="margin-right:350px; margin-top: 10px; border-radius: 8px;font-size: 15px;">
    <div class="form-group">
        <form style="width: 80%;" class="form" method="POST" action="{{ route('sector.profile',auth()->user()->id) }}" >
        @csrf
        <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>رمز فعلی:</label>
            <input class="form-control" type="password" name="current_pwd"  placeholder="Current password" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>رمز جدید:</label>
            <input class="form-control" type="password" name="new_pwd"  placeholder="New password" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>تائید رمز جدید:</label>
            <input class="form-control" type="password"  name="confirm_pwd"  placeholder="Confirm new password" autocomplete="off" required>
         </div>
            <br>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info  waves-effect waves-light">تغیرداده شود</button>
            </div>
        </form>
    </div>
    </div>
</div>

</body>
</html>
@endsection