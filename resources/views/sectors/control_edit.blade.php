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
            
<h4  style="text-align:center;">نظارت از مرجع</h4>
<hr/>
<div class="custom-modal-text text-left">

<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.control_edit', $data['id']) }}" >
@csrf
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label for="source" class="control-label">مرجع:</label>
			<input type="text" id="source" name="source" class="form-control" value="{{$data['source']}}" autocomplete="off"  />
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
			<label for="date" class="control-label">تاریخ نظارت:</label>
			<input type="text" id="date" name="date" data-targetselector="#date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="controller" class="control-label">نظارت کننده:</label>
			<input type="text" id="controller" name="controller" class="form-control" value="{{$data['controller']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
		<label for="type" class="control-label">نوعیت نظارت:</label>
			<select name="type" class="form-control">
				<option></option>
				<option value="حضوری" @if($data['type'] == "حضوری") selected @endif>حضوری</option>
				<option value="تیلفونی" @if( $data['type'] == "تیلفونی") selected @endif>تیلفونی</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="step" class="control-label">مرحله نظارت:</label>
			<select name="step" class="form-control">
				<option></option>
				<option value="پلان" @if($data['step'] == "پلان") selected @endif>پلان</option>
				<option value="اجرا" @if($data['step'] == "اجرا") selected @endif>اجرا</option>
				<option value="گزارش" @if($data['step'] == "گزارش") selected @endif>گزارش</option>
			</select>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
			<label for="progress" class="control-label">اجراآت صورت گرفته و پیشرفت کار:</label>
			<textarea id="progress" name="progress" class="form-control">{{ $data['progress']}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="result" class="control-label">نتیجه نظارت:</label>
			<textarea id="result" name="result" class="form-control">{{$data['result']}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="decision" class="control-label">اتخاذ تصامیم لازم:</label>
			<textarea id="decision" name="decision" class="form-control">{{$data['decision']}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="remarks" class="control-label">ملاحظات:</label>
			<textarea id="remarks" name="remarks" class="form-control">{{$data['remarks']}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="file" class="control-label">فایل:</label>
			<input type="file" class="form-control" name="file" id="file" />
		</div>
		@if(!empty($data['file']))
			<p>فایل موجود است</p>
			<input type="hidden" value="{{ $data['file'] }}" name="prevFile" />
		@endif
	</div>
</div>
<div class="modal-footer">
	<button type="submit" id="submit"class="btn btn-warning  waves-effect waves-light">ویرایش معلومات</button>
</div>
</form>

</div>
</div>        
@endsection        
