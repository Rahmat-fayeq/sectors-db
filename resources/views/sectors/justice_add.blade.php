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
            
<h4  style="text-align:center;">قضایای تعقیب عدلی</h4>
<hr/>
<div class="custom-modal-text text-left">

<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.justice_add') }}" >
@csrf
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_no" class="control-label"><span style="color:red">*</span>نمبرصلاحیت نامه:</label>
			<select class="form-control"  id="maktob_no" name="maktob_no">
			<option> </option>
			@foreach($maktob_no as $no)
				<option value="{{ $no->maktob_no }}" @if(!empty(@old('maktob_no')) && $no['maktob_no'] == @old('maktob_no')) selected @endif> {{ $no->maktob_no }} </option>
			@endforeach
			</select>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label for="source" class="control-label">مرجع:</label>
			<input type="text" id="source" name="source" class="form-control" value="{{ old('source')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="auditors" class="control-label">مفتیشین:</label>
			<input type="text" id="auditors" name="auditors" class="form-control" value="{{ old('auditors')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="subject" class="control-label">موضوع : </label>
			<textarea id="subject" name="subject" class="form-control">{{ old('subject')}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_no" class="control-label">پیشنهاد نمبر:</label>
			<input type="text" id="sug_no" name="sug_no" class="form-control" value="{{ old('sug_no')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sug_date" class="control-label">تاریخ پیشنهاد:</label>
			<input type="text" id="sug_date" name="sug_date" data-targetselector="#sug_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('sug_date')}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="board_no" class="control-label">مکتوب نمبر به کمیته عدلی:</label>
			<input type="text" id="board_no" name="board_no" class="form-control" value="{{ old('board_no')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="board_date" class="control-label">تاریخ مکتوب به کمیته عدلی:</label>
			<input type="text" id="board_date" name="board_date" data-targetselector="#board_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('board_date')}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="result" class="control-label">مصوبه جلسه:</label>
			<textarea id="result" name="result" class="form-control">{{ old('result')}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="result_no" class="control-label">نمبر مصوبه:</label>
			<input type="text" id="result_no" name="result_no" class="form-control" value="{{ old('result_no')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="result_date" class="control-label">تاریخ مصوبه:</label>
			<input type="text" id="result_date" name="result_date" data-targetselector="#result_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('result_date')}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="judge_no" class="control-label">نمبر مکتوب ارسال به ثارنوالی:</label>
			<input type="text" id="judge_no" name="judge_no" class="form-control" value="{{ old('judge_no')}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="judge_date" class="control-label">تاریخ مکتوب ارسال به ثارنوالی:</label>
			<input type="text" id="judge_date" name="judge_date" data-targetselector="#judge_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('judge_date')}}" autocomplete="off">
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
			<label for="remarks" class="control-label">ملاحظات:</label>
			<textarea id="remarks" name="remarks" class="form-control">{{ old('remarks')}}</textarea>
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
