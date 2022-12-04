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
            
<h4  style="text-align:center;">ثبت مکتوب</h4>
<hr/>
<div class="custom-modal-text text-left">

<form role="form" method="post" action="{{ route('sector.maktob_add') }}" >
@csrf
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_no" class="control-label"><span style="color:red;">*</span>نمبر مکتوب:</label>
			<input type="text" id="maktob_no" name="maktob_no" class="form-control" value="{{ old('maktob_no')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="date" class="control-label"><span style="color:red;">*</span>تاریخ مکتوب:</label>
			<input type="text" id="date" name="maktob_date" data-targetselector="#date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('maktob_date')}}"  autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_subject" class="control-label"><span style="color:red;">*</span>موضوع مکتوب: </label>
			<textarea id="maktob_subject" name="maktob_subject" class="form-control">{{ old('maktob_subject')}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_sender" class="control-label"><span style="color:red;">*</span>مرجع:</label>
			<input type="text" id="maktob_sender" name="maktob_sender" class="form-control" value="{{ old('maktob_sender')}}" autocomplete="off"  />
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
			<label for="received_no" class="control-label">نمبر وارده شعبه :</label>
			<input type="number" id="received_no" name="received_no" class="form-control" value="{{ old('received_no')}}" autocomplete="off"/>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="date1" class="control-label">تاریخ وارده شعبه :</label>
			<input type="text" id="date1" name="received_date" data-targetselector="#date1" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('received_date')}}"  autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="type" class="control-label"><span style="color:red;">*</span>نوعیت مکتوب:</label>
			<select class="form-control"  id="type" name="type" >
				<option> </option>
				<option value="داخلی">داخلی</option>
				<option value="خارجی">خارجی</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_type" class="control-label"><span style="color:red;">*</span>نوعیت مکتوب:</label>
			<select class="form-control"  id="maktob_type" name="maktob_type" >
				<option> </option>
				<option value="وارده">وارده</option>
				<option value="صادره">صادره</option>
			</select>
		</div>
	</div>
	
</div>

<div class="modal-footer">
	<button type="submit" class="btn btn-success btn-lg waves-effect waves-light">ثبت معلومات</button>
</div>
</form>
<hr style="margin-top:-2px" />
<div>
	<a href="{{route('sector.maktob_saved_add')}}" class="btn btn-info btn-xs">حفظیه</a>
	<a href="{{route('sector.maktob_response_add')}}" class="btn btn-info btn-xs">جواب</a>
	<a href="{{route('sector.maktob_salahiat_add')}}" class="btn btn-info btn-xs">صلاحیت نامه</a>
	<a href="{{route('sector.maktob_plan_add')}}" class="btn btn-info btn-xs">پلان</a>
</div>
</div>
</div> 
       
@endsection        
