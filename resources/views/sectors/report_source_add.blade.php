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
	<h4  style="text-align:center;">ثبت گزارش مرجع</h4>
	<hr/>
	<div class="custom-modal-text text-left">

		<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.report_source_add') }}" >
		@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="maktob_no" class="control-label"><span style="color:red;">*</span>نمبر صلاحیت نامه مربوطه:</label>
						<select class="form-control"  id="maktob_no" name="maktob_no" >
							<option> </option>
							@foreach($salahiat_numbers as $data)
							<option value="{{ $data->maktob_no }}" @if(!empty(@old('maktob_no')) && $data['maktob_no']==@old('maktob_no')) selected @endif> {{ $data->maktob_no }} </option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="report_no" class="control-label"><span style="color:red;">*</span>نمبر مکتوب :</label>
						<input type="text" id="report_no" name="report_no" class="form-control" value="{{ old('report_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="report_date" class="control-label"><span style="color:red;">*</span>تاریخ مکتوب :</label>
						<input type="text" id="report_date" name="report_date" data-targetselector="#report_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('report_date')}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="report_subject" class="control-label"> <span style="color:red;">*</span> موضوع مکتوب : </label>
						<textarea id="report_subject" name="report_subject" class="form-control">{{ old('report_subject')}}</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="city" class="control-label"><span style="color:red;">*</span>ولایت:</label>
						<select class="form-control"  id="city" name="city" >
							<option> </option>
							@foreach($cities as $data)
							<option value="{{ $data->id }}" @if(!empty(@old('city')) && $data['id']==@old('city')) selected @endif> {{ $data->city }} </option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="source" class="control-label"><span style="color:red;">*</span>مرجع مربوطه:</label>
						<input type="text" id="source" name="source" class="form-control" value="{{ old('source')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="doc_no" class="control-label">نمبر کارتن: </label>
						<input type="text" id="doc_no" name="doc_no" class="form-control" value="{{ old('doc_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="shelf_no" class="control-label">نمبر الماری:</label>
						<input type="text" id="shelf_no" name="shelf_no" class="form-control" value="{{ old('shelf_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="shelf_row" class="control-label">ردیف الماری:</label>
						<input type="text" id="shelf_row" name="shelf_row" class="form-control" value="{{ old('shelf_row')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="year" class="control-label">سال:</label>
						<input type="number" id="year" name="year" class="form-control" value="{{ old('year')}}" autocomplete="off"  />
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
				<button type="submit" id="submit" class="btn btn-success  waves-effect waves-light">ثبت معلومات</button>
			</div>
		</form>
	</div>	
</div> 
       
@endsection        
