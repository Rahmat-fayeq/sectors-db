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
            
<h4  style="text-align:center;">اعتراضیه بریافته های تفتیش</h4>
<hr/>
<div class="custom-modal-text text-left">

<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.claim_edit', $data['id']) }}" >
@csrf
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label for="maktob_no" class="control-label"><span style="color:red">*</span>نمبرصلاحیت نامه:</label>
			<select class="form-control"  id="maktob_no" name="maktob_no">
			<option> </option>
			@foreach($maktob_nos as $no)
				<option value="{{ $no->maktob_no }}" @if($no['maktob_no']==$data['maktob_no']) selected @endif> {{ $no->maktob_no }} </option>
			@endforeach
			</select>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label for="subject" class="control-label"><span style="color:red">*</span>موضوع اعتراض:</label>
			<input type="text" id="subject" name="subject" class="form-control" value="{{$data['subject']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="status" class="control-label"><span style="color:red">*</span>حالت اعتراض:</label>
			<select class="form-control" id="status" name="status">
				<option value=""></option>
				<option value="تائید" @if($data['status']=='تائید') selected @endif>تائید</option>
				<option value="رد" @if($data['status']=='رد') selected @endif>رد</option>
			</select>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label for="source" class="control-label">مرجع:</label>
			<input type="text" id="source" name="source" class="form-control" value="{{$data['source']}}" autocomplete="off"  />
		</div>
	</div>

	<label class="control-label text-danger">درصورت رد فورم ذیل را تکمیل کنید:</label>
	<div class="col-md-12" style="border:1px solid red; padding: 12px;border-radius: 10px;">
		<div class="col-md-4">
			<input type="text" placeholder="نمبر مکتوب رد"  name="reject_no" class="form-control" value="{{ $data['reject_no'] }}" autocomplete="off"  />
		</div>
		<div class="col-md-4">
			<input type="text" placeholder="تاریخ مکتوب رد" name="reject_date" id="reject_date" data-targetselector="#reject_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom" value="{{$data['reject_date']}}" autocomplete="off">
		</div>
		<div class="col-md-4">
			<input type="text" placeholder="موضوع مکتوب رد" name="reject_subject" class="form-control" value="{{$data['reject_subject']}}" autocomplete="off"  />
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="analyzed_no" class="control-label">نمبر مکتوب نظرتحلیلی:</label>
			<input type="text" id="analyzed_no" name="analyzed_no" class="form-control" value="{{$data['analyzed_no']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="claim_no" class="control-label">نمبر اعتراضیه:</label>
			<input type="text" id="claim_no" name="claim_no" class="form-control" value="{{$data['claim_no']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="claim_date" class="control-label">تاریخ اعتراضیه:</label>
			<input type="text" id="claim_date" name="claim_date" data-targetselector="#claim_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['claim_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="claim_files" class="control-label">ضمیایم(تعداد اوراق):</label>
			<input type="number" id="claim_files" name="claim_files" class="form-control" value="{{$data['claim_files']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="auditors" class="control-label">مفتیشین:</label>
			<textarea id="auditors" name="auditors" class="form-control">{{$data['auditors']}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="group_no" class="control-label">نمبر مکتوب به هیئت:</label>
			<input type="text" id="group_no" name="group_no" class="form-control" value="{{$data['group_no']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="group_date" class="control-label">تاریخ مکتوب به هیئت:</label>
			<input type="text" id="group_date" name="group_date" data-targetselector="#group_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['group_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="group_recived_date" class="control-label">تاریخ دریافت گزارش از هیئت:</label>
			<input type="text" id="group_recived_date" name="group_recived_date" data-targetselector="#group_recived_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['group_recived_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="authority_date" class="control-label">تاریخ پیشنهاد به مقام:</label>
			<input type="text" id="authority_date" name="authority_date" data-targetselector="#authority_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['authority_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="hukm_no" class="control-label">نمبر حکم مقام:</label>
			<input type="text" id="hukm_no" name="hukm_no" class="form-control" value="{{$data['hukm_no']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="hukm_date" class="control-label">تاریخ حکم مقام:</label>
			<input type="text" id="hukm_date" name="hukm_date" data-targetselector="#hukm_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['hukm_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="hukm" class="control-label">حکم مقام:</label>
			<textarea id="hukm" name="hukm" class="form-control">{{$data['hukm']}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="board_no" class="control-label">نمبر مکتوب به کمیته اعتراض:</label>
			<input type="text" id="board_no" name="board_no" class="form-control" value="{{$data['board_no']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="board_date" class="control-label">تاریخ مکتوبه به کمیته اعتراض:</label>
			<input type="text" id="board_date" name="board_date" data-targetselector="#board_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['board_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="board_files" class="control-label">ضمیایم(تعداد):</label>
			<input type="number" id="board_files" name="board_files" class="form-control" value="{{$data['board_files']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="result_no" class="control-label">نمبر مصوبه:</label>
			<input type="text" id="result_no" name="result_no" class="form-control" value="{{$data['result_no']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="result_date" class="control-label">تاریخ مصوبه:</label>
			<input type="text" id="result_date" name="result_date" data-targetselector="#result_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['result_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="result" class="control-label">مصوبه جلسه:</label>
			<textarea id="result" name="result" class="form-control">{{$data['result']}}</textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="send_no" class="control-label">نمبرابلاغ به مرجع:</label>
			<input type="text" id="send_no" name="send_no" class="form-control" value="{{$data['send_no']}}" autocomplete="off"  />
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="send_date" class="control-label">تاریخ ابلاغ به مرجع:</label>
			<input type="text" id="send_date" name="send_date" data-targetselector="#send_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['send_date']}}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="file" class="control-label">فایل:</label>
			<input type="file" class="form-control" name="file" id="file" />
		</div>
		@if(!empty($data['file']))
			<p>فایل قبلی موجود است</p>
			<input type="hidden" value="{{ $data['file'] }}" name="prevFile" />
		@else 
		<p>فایل موجود نیست</p>	
		@endif
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label for="remarks" class="control-label">ملاحظات:</label>
			<textarea id="remarks" name="remarks" class="form-control">{{$data['remarks']}}</textarea>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="submit" id="submit" class="btn btn-success  waves-effect waves-light">ویرایش معلومات</button>
</div>
</form>

</div>
</div>        
@endsection        
