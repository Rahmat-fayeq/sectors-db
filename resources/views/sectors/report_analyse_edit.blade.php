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
 
<div class="container" style="background-color: white;border-radius: 10px;box-shadow: 1px 2px 12px 12px silver;margin-bottom:2rem">
	<h4  style="text-align:center;">ویرایش گزارش ریاست تحلیل</h4>
	<hr/>
	<div class="custom-modal-text text-left">

		<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.report_analyse_edit', $data['id']) }}" >
		@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="maktob_no" class="control-label"><span style="color:red;">*</span>نمبر صلاحیت نامه:</label>
						<select class="form-control"  id="maktob_no" name="maktob_no" >
							<option> </option>
							@foreach($salahiat_numbers as $no)
								<option value="{{ $no->maktob_no }}" @if($data['maktob_no']==$no['maktob_no']) selected @endif>{{ $no->maktob_no }}</option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="send_report_no" class="control-label"><span style="color:red;">*</span>نمبر مکتوب ارسال:</label>
						<input type="text" id="send_report_no" name="send_report_no" class="form-control" value="{{$data['send_report_no']}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="send_report_date" class="control-label"><span style="color:red;">*</span>تاریخ مکتوب ارسال:</label>
						<input type="text" id="send_report_date" name="send_report_date" data-targetselector="#send_report_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['send_report_date']}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="send_report_subject" class="control-label"> <span style="color:red;">*</span> موضوع مکتوب ارسال: </label>
						<textarea id="send_report_subject" name="send_report_subject" class="form-control">{{$data['send_report_subject']}}</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="receive_report_no" class="control-label">نمبر مکتوب دریافت:</label>
						<input type="text" id="receive_report_no" name="receive_report_no" class="form-control" value="{{$data['receive_report_no']}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="receive_report_date" class="control-label">تاریخ مکتوب دریافت:</label>
						<input type="text" id="receive_report_date" name="receive_report_date" data-targetselector="#receive_report_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['receive_report_date']}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="receive_report_subject" class="control-label"> موضوع مکتوب دریافت: </label>
						<textarea id="receive_report_subject" name="receive_report_subject" class="form-control">{{$data['receive_report_subject']}}</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="status" class="control-label">حالت گزارش:</label>
						<select class="form-control"  id="status" name="status" >
							<option> </option>
							<option value="تائید" @if($data['status'] == "تائید") selected @endif>تائید</option>
							<option value="رد" @if($data['status'] == "رد") selected @endif>رد</option>		
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="send_verify_date" class="control-label">تاریخ ارائه گزارش جهت منظوری به مقام:</label>
						<input type="text" id="send_verify_date" name="send_verify_date" data-targetselector="#send_verify_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['send_verify_date']}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="receive_verify_date" class="control-label">تاریخ دریافت گزارش منظور شده از مقام:</label>
						<input type="text" id="receive_verify_date" name="receive_verify_date" data-targetselector="#receive_verify_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['receive_verify_date']}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="export_date" class="control-label">تاریخ ارائه گزارش جهت اصدار به ریاست دفتر:</label>
						<input type="text" id="export_date" name="export_date" data-targetselector="#export_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['export_date']}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="doc_no" class="control-label">نمبر کارتن: </label>
						<input type="text" id="doc_no" name="doc_no" class="form-control" value="{{$data['doc_no']}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="shelf_no" class="control-label">نمبر الماری:</label>
						<input type="text" id="shelf_no" name="shelf_no" class="form-control" value="{{$data['shelf_no']}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="shelf_row" class="control-label">ردیف الماری:</label>
						<input type="text" id="shelf_row" name="shelf_row" class="form-control" value="{{$data['shelf_row']}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="year" class="control-label">سال:</label>
						<input type="number" id="year" name="year" class="form-control" value="{{$data['year']}}" autocomplete="off"  />
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
				<button type="submit" id="submit" class="btn btn-warning  waves-effect waves-light">ویرایش معلومات</button>
			</div>
		</form>
	</div>	
</div> 
       
@endsection        
