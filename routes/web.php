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

/**
 * MAIN
 */
Route::get('logout', 'AuthController@logout');
Route::get('403', 'PageController@invalidAccess');
Route::post('auth', 'AuthController@index');
Route::redirect('/', url('/myaudit'));

/*
* MODALS
*/
Route::get('maintenance/checklist/add/show', 'MaintenanceController@showAddChecklist');
Route::get('maintenance/category/add/show', 'MaintenanceController@showAddCategory');
Route::get('audit/location/disapprove/show', 'AuditController@showModalDisapprove');
Route::post('answer/filter/table/show', 'AnswerController@showFilter');
Route::post('audit/location/filter/show', 'AuditController@showAuditLocFilter');
Route::post('audit/department/filter/show', 'AuditController@showAuditDepFilter');
Route::post('reports/department/filter/show', 'ReportsController@showAuditDepFilter');
Route::post('reports/location/filter/show', 'ReportsController@showAuditLocFilter');
Route::post('approval/audit/location/filter/show', 'AuditController@showModalFilterAppAuditAM');

/*
* CONTENT
*/
Route::get('maintenance/checklist/category/show/{id}', 'MaintenanceController@showCategory');
Route::get('answer/category/show/{id}', 'AnswerController@showAnswerCategory');
Route::get('answer/rca/category/show/{id}', 'AuditController@showRCAAnswerCategory');
Route::post('answer/question/show', 'AnswerController@showQuestions');
Route::post('audit/rca/question/show', 'AuditController@showRCAQuestions');
Route::post('maintenance/checklist/question/show', 'MaintenanceController@showQuestions');

/*
* TABLES
*/
Route::post('maintenance/checklist/table/show', 'MaintenanceController@showChecklistTable');
Route::post('answer/active/checklist/table/show', 'AnswerController@showRegularActiveChecklist');
Route::post('answer/checklist/table/show', 'AnswerController@showAnsweredChecklists');
Route::post('audit/department/list/table/show', 'AuditController@showDepartmentTable');
Route::post('audit/store/list/table/show', 'AuditController@showStoresTable');
Route::post('audit/active/department/checklist/table/show', 'AuditController@showDepActiveChecklist');
Route::post('audit/active/location/checklist/table/show', 'AuditController@showLocActiveChecklist');
Route::post('audit/location/table/show', 'AuditController@showAuditLocation');
Route::post('audit/department/table/show', 'AuditController@showAuditDepartment');
Route::post('reports/location/table/show', 'ReportsController@showRPTAuditLocation');
Route::post('reports/department/table/show', 'ReportsController@showRPTAuditDepartment');
Route::post('approval/audit/location/table/show', 'AuditController@showTableAppAuditAM');
Route::post('acceptance/audit/location/table/show', 'AuditController@showAuditAcceptanceTable');
Route::post('rca/audit/location/table/show', 'AuditController@showAuditRCATable');

/*
* PAGES
*/

/* My Audit */
Route::get('myaudit', 'PageController@myaudit');

/* My Answers */
Route::get('myanswers', 'PageController@myanswer');

/* Reports -> QA */
Route::get('reports', 'PageController@reports');

/* Answer Checklist */
Route::get('answer/{id}', 'PageController@answerChecklist');
Route::get('answer/audit/location/{id}', 'PageController@auditLocAnswerChecklist');
Route::get('answer/audit/department/{id}', 'PageController@auditDepAnswerChecklist');
Route::get('answer/audit/monitoring/{id}', 'PageController@postRequisiteChecklist');
Route::get('answer/audit/focus/{id}', 'PageController@postRequisiteChecklist');
Route::get('answer/audit/rca/{id}', 'PageController@rcaChecklist');

/* Audit Location */
Route::get('audit/location', 'PageController@auditstore');

/* RCA -> AC */
Route::get('sqa/menu/{id}', 'PageController@storeQualityAuditMenu');
Route::get('rca', 'PageController@rca');

/* Acceptance -> Store Personnel */
Route::get('acceptance', 'PageController@acceptance');

/* Audit Department */
Route::get('audit/department', 'PageController@auditdepartment');

/* Maintenance */
Route::get('maintenance/checklist', 'PageController@maintenance');
Route::get('maintenance/checklist/edit/{id}', 'PageController@editChecklist');

/* Approval */
Route::get('myapproval', 'PageController@myapproval');

/*
* MAINTENANCE ~ INSERT ~ UPDATE ~ DELETE
*/
Route::post('checklist/add', 'MaintenanceController@addChecklist');
Route::post('checklist/update/{id}', 'MaintenanceController@updateChecklist');
Route::post('checklist/activate', 'MaintenanceController@updateActiveChecklist');
Route::post('checklist/delete', 'MaintenanceController@removeChecklist');
Route::post('checklist/category/add', 'MaintenanceController@addCategory');
Route::post('checklist/category/update', 'MaintenanceController@updateCategory');
Route::post('checklist/category/delete', 'MaintenanceController@removeCategory');
Route::post('checklist/item/add', 'MaintenanceController@addItem');
Route::post('checklist/item/update', 'MaintenanceController@updateItem');
Route::post('checklist/item/description/update', 'MaintenanceController@updateItemDesc');
Route::post('checklist/item/portion/update', 'MaintenanceController@updateItemPortion');
Route::post('checklist/item/delete', 'MaintenanceController@updateItemDeleted');
Route::post('checklist/item/duplicate', 'MaintenanceController@duplicateItem');
Route::post('checklist/item/require', 'MaintenanceController@updateItemRequired');
Route::post('checklist/item/type/update', 'MaintenanceController@updateItemType');
Route::post('checklist/option/add', 'MaintenanceController@addItemOption');
Route::post('checklist/option/update', 'MaintenanceController@updateItemOption');
Route::post('checklist/option/rate/update', 'MaintenanceController@updateOptionRate');
Route::post('checklist/option/ratecode/update', 'MaintenanceController@updateOptionRateCode');
Route::post('checklist/option/delete', 'MaintenanceController@removeItemOption');

/*
* ANSWER ~ INSERT ~ UPDATE ~ DELETE
*/
Route::post('answer/start', 'AnswerController@startAnswer');
Route::post('answer/input/update', 'AnswerController@answerTextUpdate');
Route::post('answer/selected/update', 'AnswerController@answerSelectUpdate');
Route::post('answer/checked/update', 'AnswerController@answerCheckUpdate');
Route::post('answer/remarks/update', 'AnswerController@answerItemRemarksUpdate');
Route::post('answer/submit', 'AnswerController@submitAnswerChecklist');
Route::post('answer/item/file-upload/{id}', 'AnswerController@checklistFileUpload');
Route::post('answer/item/file-delete', 'AnswerController@deleteFile');
Route::get('upload/get/{id}', 'AnswerController@getChecklistItemFiles');

/*
* CHECKING
*/
Route::post('answer/items/required/check', 'AnswerController@checkAnswerItemRequired');
Route::post('answer/items/done/check', 'AnswerController@checkAnswerItemDoneRequired');
Route::post('rca/items/done/check', 'AuditController@checkRCAItemDone');

/*
* AUDIT ~ INSERT ~ UPDATE ~ DELETE
*/
Route::post('answer/audit/department/start', 'AuditController@startAuditDepAnswer');
Route::post('answer/audit/location/start', 'AuditController@startAuditLocAnswer');
Route::post('answer/audit/rca/insert', 'AuditController@updateInsertItemRCA');
Route::post('audit/location/submit', 'AuditController@submitStoreQualityAudit');
Route::post('audit/location/remarks/update', 'AuditController@updateAuditLocationRemarks');
Route::post('audit/location/approval/insert', 'AuditController@approveAuditLocation');

/*
* POST VIEW ANSWERS
*/
Route::get('view/answer/{id}', 'PageController@postviewACL');
Route::get('view/audit/location/{id}', 'PageController@postviewALACL');
Route::get('view/audit/department/{id}', 'PageController@postviewADACL');

/*
* REPORTS
*/
Route::get('export/answer/{id}', 'ReportsController@exportAnswers');
Route::get('export/audit/location/{id}', 'ReportsController@exportAuditLocation');
Route::get('export/audit/department/{id}', 'ReportsController@exportAuditDepartment');
Route::get('export/audit/location/sqa/{id1}/{id2}/{id3}', 'ReportsController@exportSQA');
Route::get('export/audit/location/rca/{id}', 'ReportsController@exportPdfRCA');
Route::get('export/pdf/audit/location/sqa/{id1}/{id2}/{id3}', 'ReportsController@exportPdfSQA');
Route::get('export/summary/{from}/{to}', 'ReportsController@exportRatingSummary');

/*
* Response and Corrective Action ~ INSERT ~ UPDATE ~ DELETE
*/
Route::post('rca/audit/location/submit', 'AuditController@submitACAuditLocation');

/*
* Acceptance ~ INSERT ~ UPDATE ~ DELETE
*/
Route::post('acceptance/audit/location/accept', 'AuditController@acceptAuditLocation');

Route::get('clear-all', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    echo 'success';
});

Route::get('foo', function(){
    Artisan::call('storage:link');

    echo 'success';
});