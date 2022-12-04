@extends('layouts.sector_layouts.sector_layout')
 @section('content')
<!DOCTYPE html>
<html>
<head>
  <link href="{{ asset('public/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" media="all">

  <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>

</head>
<body>
<div class="container" style="background-color: skyblue;border-radius: 10px;color:white; width:80%">
  <h2 style="color:white;"><center>ثبت کاربر جدید</center></h2>
   <div class="col-xs-4" style="margin-right:350px; margin-top: 10px; border-radius: 8px;font-size: 15px;">
    <div class="form-group">
        <form style="width: 80%;" class="form" method="POST" action="{{ route('accounts.store') }}" >
        @csrf

        <input type="hidden" name="role_id" value="sector" />
        <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>نام کاربر:</label>
            <input class="form-control" type="text" name="name"  placeholder="Ahmad Ahmadi" value="{{ old('name') }}"autocomplete="off" required>
            @error('name')  
            <p style="color:red;font-style:italic">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>ایمیل کاربر:</label>
            <input class="form-control" type="email" name="email"  placeholder="example@example.com" value="{{ old('email')}}"" autocomplete="off" required>
            @error('email')  
            <p style="color:red;font-style:italic">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>رمز جدید:</label>
            <input class="form-control" type="password" name="password"  placeholder="New password" autocomplete="off" required>
            @error('password')  
            <p style="color:red;font-style:italic">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>تائید رمز جدید:</label>
            <input class="form-control" type="password"  name="password_confirmation"  placeholder="Confirm new password" autocomplete="off" required>
         </div>
         <div class="form-group">
            <label style="margin-top: 10px;"><span style="color:red;">*</span>نوعیت کاربر:</label>
            <select class="form-control" name="role" required>
                <option></option>
                <option value="admin">ادمین</option>
                <option value="head">آمر</option>
                <option value="employee">کارمند</option>
            </select>
            @error('role')  
            <p style="color:red;font-style:italic">{{$message}}</p>
            @enderror
         </div>
         
            <br>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success  waves-effect waves-light">ذخیره</button>
            </div>
        </form>
    </div>
    </div>
</div>

</body>
</html>
@endsection