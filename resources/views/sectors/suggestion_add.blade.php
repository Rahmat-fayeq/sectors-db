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
            
<h4  style="text-align:center;">ثبت پیشنهاد</h4>
<hr/>
<div class="custom-modal-text text-left">

<form role="form" method="post" action="{{ route('sector.suggestion_add') }}" >
@csrf
<div class="row">	
	
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_no" class="control-label"><span style="color:red;">*</span>نمبر پیشنهاد:</label>
			<input type="text" id="sug_no" name="sug_no" class="form-control" value="{{ old('sug_no')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_date" class="control-label"><span style="color:red;">*</span>تاریخ پیشنهاد:</label>
			<input type="text" id="sug_date" name="sug_date" data-targetselector="#sug_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('sug_date')}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_subject" class="control-label"><span style="color:red;">*</span>موضوع پیشنهاد: </label>
			<textarea id="sug_subject" name="sug_subject" class="form-control">{{ old('sug_subject')}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_verify_date" class="control-label">تاریخ حکم:</label>
			<input type="text" id="sug_verify_date" name="sug_verify_date" data-targetselector="#sug_verify_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('sug_verify_date')}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_status" class="control-label">حالت پیشنهاد:</label>
			<select class="form-control" id="sug_status" name="sug_status" >
				<option> </option>
				<option value="تائید">تائید</option>
				<option value="رد">رد</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="file" class="control-label">فایل:</label>
			<input type="file" class="form-control" name="file" id="file" />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_remarks" class="control-label">ملاحظات:</label>
			<textarea id="sug_remarks" name="sug_remarks" class="form-control">{{ old('sug_remarks')}}</textarea>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="submit" id="submit"class="btn btn-success  waves-effect waves-light">ثبت معلومات</button>
</div>
</form>

</div>
</div>        
@endsection        
