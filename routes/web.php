<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>['auth']], function(){
	Route::prefix('/dashboard')->namespace('App\Http\Controllers')->group(function()
	{	// sector
		Route::match(['get','post'],'/maktob-add','SectorsController@addMaktob')->name('sector.maktob_add')->middleware('role:sector');
		Route::get('/maktob-show','SectorsController@showMaktob')->name('sector.maktob_show')->middleware('role:sector');
		Route::get('/maktob-delete/{id}','SectorsController@deleteMaktob')->name('sector.maktob_delete')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-edit/{id?}','SectorsController@editMaktob')->name('sector.maktob_edit')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-saved-add','SectorsController@addSavedMaktob')->name('sector.maktob_saved_add')->middleware('role:sector');
		Route::get('/maktob-saved-show','SectorsController@showSavedMaktob')->name('sector.maktob_saved_show')->middleware('role:sector');
		Route::get('/file-download/{file}','SectorsController@fileDownload')->name('sector.download')->middleware('role:sector');
		Route::get('/maktob-saved-delete/{id}','SectorsController@deleteSavedMaktob')->name('sector.maktob_saved_delete')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-saved-edit/{id?}','SectorsController@editSavedMaktob')->name('sector.maktob_saved_edit')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-response-add','SectorsController@addResponseMaktob')->name('sector.maktob_response_add')->middleware('role:sector');
		Route::get('/maktob-response-show','SectorsController@showResponseMaktob')->name('sector.maktob_response_show')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-response-edit/{id?}','SectorsController@editResponseMaktob')->name('sector.maktob_response_edit')->middleware('role:sector');
		Route::get('/maktob-response-delete/{id}','SectorsController@deleteResponseMaktob')->name('sector.maktob_response_delete')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-salahiat-add','SectorsController@addSalahiatMaktob')->name('sector.maktob_salahiat_add')->middleware('role:sector');
		Route::get('/maktob-salahiat-show','SectorsController@showSalahiatMaktob')->name('sector.maktob_salahiat_show')->middleware('role:sector');
		Route::get('/salahiat-file-download/{file}','SectorsController@salahiatFileDownload')->name('sector.salahiat_download')->middleware('role:sector');
		Route::get('/salahiat-delete/{id}','SectorsController@deleteSalahiatMaktob')->name('sector.salahiat_delete')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-salahiat-edit/{id?}','SectorsController@editSalahiatMaktob')->name('sector.maktob_salahiat_edit')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-plan-add','SectorsController@addPlanMaktob')->name('sector.maktob_plan_add')->middleware('role:sector');
		Route::get('/maktob-plan-show','SectorsController@showPlanMaktob')->name('sector.maktob_plan_show')->middleware('role:sector');
		Route::get('/plan-file-download/{file}','SectorsController@planFileDownload')->name('sector.plan_download')->middleware('role:sector');
		Route::get('/maktob-plan-delete/{id}','SectorsController@deletePlanMaktob')->name('sector.maktob_plan_delete')->middleware('role:sector');
		Route::match(['get','post'],'/maktob-plan-edit/{id?}','SectorsController@editPlanMaktob')->name('sector.maktob_plan_edit')->middleware('role:sector');
		Route::match(['get','post'],'/report-auditor-add','SectorsController@addAuditorReport')->name('sector.report_auditor_add')->middleware('role:sector');
		Route::get('/report-auditor-show','SectorsController@showAuditorReport')->name('sector.report_auditor_show')->middleware('role:sector');
		Route::get('/report-auditor-download/{file}','SectorsController@reportAuditorFileDownload')->name('sector.report_auditor_download')->middleware('role:sector');
		Route::get('/report-auditor-delete/{id}','SectorsController@deleteAuditorReport')->name('sector.report_auditor_delete')->middleware('role:sector');
		Route::match(['get','post'],'/report-auditor-edit/{id?}','SectorsController@editAuditorReport')->name('sector.report_auditor_edit')->middleware('role:sector');
		Route::match(['get','post'],'/report-analyse-add','SectorsController@addAnalyseReport')->name('sector.report_analyse_add')->middleware('role:sector');
		Route::get('/report-analyse-show','SectorsController@showAnalyseReport')->name('sector.report_analyse_show')->middleware('role:sector');
		Route::get('/report-analyse-download/{file}','SectorsController@reportAnalyseFileDownload')->name('sector.report_analyse_download')->middleware('role:sector');
		Route::get('/report-analyse-delete/{id}','SectorsController@deleteAnalyseReport')->name('sector.report_analyse_delete')->middleware('role:sector');
		Route::match(['get','post'],'/report-analyse-edit/{id?}','SectorsController@editAnalyseReport')->name('sector.report_analyse_edit')->middleware('role:sector');
		Route::match(['get','post'],'/report-source-add','SectorsController@addSourceReport')->name('sector.report_source_add')->middleware('role:sector');
		Route::get('/report-source-show','SectorsController@showSourceReport')->name('sector.report_source_show')->middleware('role:sector');
		Route::get('/report-source-download/{file}','SectorsController@reportSourceFileDownload')->name('sector.report_source_download')->middleware('role:sector');
		Route::get('/report-source-delete/{id}','SectorsController@deleteSourceReport')->name('sector.report_source_delete')->middleware('role:sector');
		Route::match(['get','post'],'/report-source-edit/{id?}','SectorsController@editSourceReport')->name('sector.report_source_edit')->middleware('role:sector');
		Route::match(['get','post'],'/auditor-add','SectorsController@addAuditor')->name('sector.auditor_add')->middleware('role:sector');
		Route::get('/auditor-show','SectorsController@showAuditor')->name('sector.auditor_show')->middleware('role:sector');
		Route::match(['get','post'],'/auditor-edit/{id?}','SectorsController@editAuditor')->name('sector.auditor_edit')->middleware('role:sector');
		Route::get('/auditor-delete/{id}','SectorsController@deleteAuditor')->name('sector.auditor_delete')->middleware('role:sector');
		Route::match(['get','post'],'/suggestion-add','SectorsController@addSuggestion')->name('sector.suggestion_add')->middleware('role:sector');
		Route::get('/suggestion-show','SectorsController@showSuggestion')->name('sector.suggestion_show')->middleware('role:sector');
		Route::match(['get','post'],'/suggestion-edit/{id?}','SectorsController@editSuggestion')->name('sector.suggestion_edit')->middleware('role:sector');
		Route::get('/suggestion-download/{file}','SectorsController@downloadSuggestion')->name('sector.suggestion_download')->middleware('role:sector');
		Route::get('/suggestion-delete/{id}','SectorsController@deleteSuggestion')->name('sector.suggestion_delete')->middleware('role:sector');
		Route::match(['get','post'],'/claim-add','SectorsController@addClaim')->name('sector.claim_add')->middleware('role:sector');
		Route::get('/claim-show','SectorsController@showClaim')->name('sector.claim_show')->middleware('role:sector');
		Route::get('/claim-download/{file}','SectorsController@downloadClaim')->name('sector.claim_download')->middleware('role:sector');
		Route::get('/claim-delete/{id}','SectorsController@deleteClaim')->name('sector.claim_delete')->middleware('role:sector');
		Route::match(['get','post'],'/claim-edit/{id?}','SectorsController@editCliam')->name('sector.claim_edit')->middleware('role:sector');
		Route::match(['get','post'],'/justice-add','SectorsController@addJustice')->name('sector.justice_add')->middleware('role:sector');
		Route::get('/justice-show','SectorsController@showJustice')->name('sector.justice_show')->middleware('role:sector');
		Route::get('/justice-download/{file}','SectorsController@downloadJustice')->name('sector.justice_download')->middleware('role:sector');
		Route::get('/justice-delete/{id}','SectorsController@deleteJustice')->name('sector.justice_delete')->middleware('role:sector');
		Route::match(['get','post'],'/justice-edit/{id?}','SectorsController@editJustice')->name('sector.justice_edit')->middleware('role:sector');
		Route::match(['get','post'],'/control-add','SectorsController@addControl')->name('sector.control_add')->middleware('role:sector');
		Route::get('/control-show','SectorsController@showControl')->name('sector.control_show')->middleware('role:sector');
		Route::get('/control-delete/{id}','SectorsController@deleteControl')->name('sector.control_delete')->middleware('role:sector');
		Route::match(['get','post'],'/control-edit/{id?}','SectorsController@editControl')->name('sector.control_edit')->middleware('role:sector');
		Route::get('/control-download/{file}','SectorsController@downloadControl')->name('sector.control_download')->middleware('role:sector');
		
		//Excel Routes
		Route::get('/control-excel','SectorsController@ControlExcel')->name('sector.control_excel')->middleware('role:sector');
		Route::get('/justice-excel','SectorsController@JusticeExcel')->name('sector.justice_excel')->middleware('role:sector');
		Route::get('/cliam-excel','SectorsController@CliamExcel')->name('sector.cliam_excel')->middleware('role:sector');
		Route::get('/suggesion-excel','SectorsController@SuggestionExcel')->name('sector.suggestion_excel')->middleware('role:sector');
		Route::get('/auditor-excel','SectorsController@AuditorExcel')->name('sector.auditor_excel')->middleware('role:sector');
		Route::get('/maktob-saved-excel','SectorsController@MaktobSavedExcel')->name('sector.maktob_saved_excel')->middleware('role:sector');
		Route::get('/maktob-response-excel','SectorsController@MaktobResponseExcel')->name('sector.maktob_response_excel')->middleware('role:sector');
		Route::get('/maktob-salahiat-excel','SectorsController@MaktobSalahiatExcel')->name('sector.maktob_salahiat_excel')->middleware('role:sector');
		Route::get('/maktob-plan-excel','SectorsController@MaktobPlanExcel')->name('sector.maktob_plan_excel')->middleware('role:sector');
		Route::get('/report-auditor-excel','SectorsController@ReportAuditorExcel')->name('sector.report_auditor_excel')->middleware('role:sector');
		Route::get('/report-analyse-excel','SectorsController@ReportAnalyseExcel')->name('sector.report_analyse_excel')->middleware('role:sector');
		Route::get('/report-source-excel','SectorsController@ReportSourceExcel')->name('sector.report_source_excel')->middleware('role:sector');
		//Old Rotues
		Route::get('/','SectorsController@index')->name('sector');
		Route::get('/about','SectorsController@about')->name('sector.about')->middleware('role:sector');
		Route::match(['get','post'],'/profile/{id?}','SectorsController@profile')->name('sector.profile')->middleware('role:sector');

		// Acounts management Routes
		Route::resource('/accounts','AccountsController');

		// kinds of Reports
		Route::get('/reports','ReportsController@index')->name('reports');
		Route::post('/reports','ReportsController@search')->name('search');
		Route::post('/export','ReportsController@export')->name('export');
		
	});

});

require __DIR__.'/auth.php';
