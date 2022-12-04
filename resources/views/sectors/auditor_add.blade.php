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
<div class="alert alert-danger" style="color:white">
<ul>
	@foreach ( $errors->all() as $error )
	<li> {{ $error }} </li>
	@endforeach
</ul>
</div>
@endif
 
 <div class="container" style="background-color: white;border-radius: 10px;box-shadow: 1px 2px 12px 12px silver;margin-bottom:2rem">
            
<h4  style="text-align:center;">ثبت مفتیش</h4>
<hr/>
<div class="custom-modal-text text-left">

<form role="form" method="post" action="{{ route('sector.auditor_add') }}" >
@csrf
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label for="name" class="control-label"><span style="color:red;">*</span>اسم کامل:</label>
			<input type="text" id="name" name="name" class="form-control" value="{{ old('name')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="fname" class="control-label">اسم پدر:</label>
			<input type="text" id="fname" name="fname" class="form-control" value="{{ old('fname')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="job" class="control-label"><span style="color:red;">*</span>عنوان بست:</label>
			<input type="text" id="job" name="job" class="form-control" value="{{ old('job')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="rank" class="control-label"><span style="color:red;">*</span>درجه بست:</label>
			<input type="number" id="rank" name="rank" class="form-control" value="{{ old('rank')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="email" class="control-label">ایمیل آدرس:</label>
			<input type="email" id="email" name="email" class="form-control" value="{{ old('email')}}" autocomplete="off"  />	
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="phone" class="control-label"><span style="color:red;">*</span>نمبر تماس:</label>
			<input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="whatsapp" class="control-label">نمبر واتسب:</label>
			<input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp')}}" autocomplete="off"  />
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label for="remarks" class="control-label">ملاحظات:</label>
			<textarea  id="remarks" name="remarks" class="form-control" autocomplete="off">{{ old('remarks')}}</textarea>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="submit" class="btn btn-success  waves-effect waves-light">ثبت معلومات</button>
</div>
</form>

</div>
</div> 
       
@endsection        
