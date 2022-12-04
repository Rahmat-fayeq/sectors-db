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
	<h4  style="text-align:center;">ثبت صلاحیت نامه</h4>
	<hr/>
	<div id="myModal" class="custom-modal-text text-left">
		<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.maktob_salahiat_add') }}" >
		@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="maktob_no" class="control-label"><span style="color:red;">*</span>نمبر صلاحیت نامه</label>
						<select class="form-control"  id="maktob_no" name="maktob_no" >
							<option> </option>
							@foreach($maktob_numbers as $data)
								<option value="{{ $data->maktob_no }}" @if(!empty(@old('maktob_no')) && $data['maktob_no']==@old('maktob_no')) selected @endif> {{ $data->maktob_no }} </option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="hukm_no" class="control-label"><span style="color:red;">*</span>نمبر حکم:</label>
						<input type="text" id="hukm_no" name="hukm_no" class="form-control" value="{{ old('hukm_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="hukm_date" class="control-label"><span style="color:red;">*</span>تاریخ حکم:</label>
						<input type="text" id="hukm_date" name="hukm_date" data-targetselector="#hukm_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('hukm_date')}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="audit_dept" class="control-label"><span style="color:red;">*</span>مرجع تحت تفتیش:</label>
						<input type="text" id="audit_dept" name="audit_dept" class="form-control" value="{{ old('audit_dept')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="city_id" class="control-label"><span style="color:red;">*</span>موقعیت:</label>
						<select class="form-control"  id="city_id" name="city_id" >
							<option> </option>
							@foreach($cities as $data)
								<option value="{{ $data->id }}" @if(!empty(@old('city_id')) && $data['id']==@old('city_id')) selected @endif> {{ $data->city }} </option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="audited_year" class="control-label"><span style="color:red;">*</span>سال بررسی:</label>
						<input type="text" id="audited_year" name="audited_year" class="form-control" value="{{ old('audited_year')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="audit_year" class="control-label"><span style="color:red;">*</span>سال تحت تفتیش:</label>
						<input type="text" id="audit_year" name="audit_year" class="form-control" value="{{ old('audit_year')}}" autocomplete="off"  />
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label"><span style="color:red;">*</span>ربع تحت تفتیش:</label>
						<br/><br/>
						<input type="checkbox" name="quarter[]" value="1" autocomplete="off" /> ربع اول &nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="quarter[]" value="2" autocomplete="off" /> ربع دوم &nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="quarter[]" value="3" autocomplete="off" /> ربع سوم &nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="quarter[]" value="4" autocomplete="off" /> ربع چهارم					
					</div>
				</div>
				
				<div class="col-md-6" style="border:1px solid silver;border-radius:10px;">
				<label class="control-label"><span style="color:red;">*</span>اعضای هیئت:</label>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="head_auditor" placeholder="آمرگروپ" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="auditor1" placeholder="عضو1" />
							</div>
						</div>
						<div class="col-md-3"
							<div class="form-group">
								<input type="text" class="form-control" name="auditor2" placeholder="عضو2" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="auditor3" placeholder="عضو3" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="auditor4" placeholder="عضو4" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="auditor5" placeholder="عضو5" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="auditor6" placeholder="عضو6" />
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="start_date" class="control-label"><span style="color:red;">*</span>تاریخ آغاز کار:</label>
						<input type="text" id="start_date" name="start_date" data-targetselector="#start_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('start_date')}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="end_date" class="control-label"><span style="color:red;">*</span>تاریخ ختم کار:</label>
						<input type="text" id="end_date" name="end_date" data-targetselector="#end_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('end_date')}}"  autocomplete="off">
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
