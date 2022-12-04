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
 
<div class="container" style="background-color: white;border-radius: 10px;">
            
<h4  style="text-align:center;">ویرایش مکتوب</h4>
<hr/>
<div class="custom-modal-text text-left">
<form role="form" method="post" action="{{ route('sector.maktob_edit', $data['id']) }}" >
	@csrf
<div class="row">			
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_no" class="control-label"><span style="color:red;">*</span>نمبر مکتوب:</label>
			<input type="text" id="maktob_no" name="maktob_no" class="form-control" value="{{ $data['maktob_no'] }}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="date" class="control-label"><span style="color:red;">*</span>تاریخ مکتوب:</label>
			<input type="text" id="date" name="maktob_date" data-targetselector="#date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ $data['maktob_date'] }}"  autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_subject" class="control-label"><span style="color:red;">*</span>موضوع مکتوب: </label>
			<textarea id="maktob_subject" name="maktob_subject" class="form-control">{{ $data['maktob_subject'] }}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_sender" class="control-label"><span style="color:red;">*</span>مرجع:</label>
			<input type="text" id="maktob_sender" name="maktob_sender" class="form-control" value="{{ $data['maktob_sender'] }}" autocomplete="off"  />
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
			<label for="received_no" class="control-label">نمبر وارده:</label>
			<input type="number" id="received_no" name="received_no" class="form-control" value="{{ $data['received_no'] }}" autocomplete="off"/>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="date1" class="control-label">تاریخ وارده:</label>
			<input type="text" id="date1" name="received_date" data-targetselector="#date1" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ $data['received_date'] }}"  autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_type" class="control-label"><span style="color:red;">*</span>نوعیت مکتوب:</label>
			<select class="form-control"  id="maktob_type" name="maktob_type" >
				<option> </option>
				<option value="وارده" @if($data['maktob_type']=='وارده' ) selected @endif>وارده</option>
				<option value="صادره" @if($data['maktob_type']=='صادره' ) selected @endif>صادره</option>
			</select>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label for="type" class="control-label"><span style="color:red;">*</span>نوعیت مکتوب:</label>
			<select class="form-control"  id="type" name="type" >
				<option> </option>
				<option value="داخلی" @if($data['type']=='داخلی' ) selected @endif>داخلی</option>
				<option value="خارجی" @if($data['type']=='خارجی' ) selected @endif>خارجی</option>
			</select>
		</div>
	</div>				
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-warning  waves-effect waves-light">ویرایش معلومات</button>
</div>
</form>

</div>
</div> 
       
@endsection        
