<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringTLController;
use App\Http\Controllers\NcController;
use App\Http\Controllers\NcrController;
use App\Http\Controllers\NcrResourceController;
use App\Http\Controllers\OfiResourceController;
use App\Http\Controllers\OfiController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\TindakLanjutNcrController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HubungiController;
use App\Http\Controllers\CATController;
use App\Models\Ncr;
use App\Models\Ofi;
use App\Models\TLNcr;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {return view('dashboard');})->middleware('auth');
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('/', [DashboardController::class, 'indexOFI'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/get/status-ncr', [NcrController::class, 'api_status_ncr'])->middleware('auth');
Route::get('/get/status-ofi', [OfiController::class, 'api_status_ofi'])->middleware('auth');
// Route::get('/get/status-nc', [NcController::class, 'api_status_nc'])->middleware('auth');
// Route::get('/get/status-ncr', [NcrController::class, 'api_status_ncr'])->middleware('auth');
// Route::get('/get/status-ofi', [OfiController::class, 'api_status_ofi'])->middleware('auth');

// Route::get('/data-nc', [NcController::class, 'index'])->middleware('auth')->name('data-nc');
// Route::get('/data-nc/add', [NcController::class, 'index_add'])->middleware('auth');
// Route::post('/data-nc/add', [NcController::class, 'store_add'])->middleware('auth');
// Route::get('/data-nc/form/{nc:id_nc}', [NcController::class, 'index_form_nc'])->middleware('auth');
// Route::post('/data-nc/form/{nc:id_nc}', [NcController::class, 'store_form_nc'])->middleware('auth');
// Route::get('/data-nc/edit/{nc:id_nc}', [NcController::class, 'index_edit'])->middleware('auth');
// Route::post('/data-nc/edit/{nc:id_nc}', [NcController::class, 'store_edit'])->middleware('auth');
// Route::get('/data-nc/delete/{nc:id_nc}/{ref_page?}', [NcController::class, 'delete'])->middleware('auth');
// Route::get('/data-nc/tlnc/input/{nc:id_nc}/{ref_page?}', [NcController::class, 'index_tlnc'])->middleware('auth');
// Route::post('/data-nc/tlnc/input/{nc:id_nc}/{ref_page?}', [NcController::class, 'store_tlnc'])->middleware('auth');
// Route::get('/data-nc/tlnc/view/{nc:id_nc}/{ref_page?}', [NcController::class, 'view_tlnc'])->middleware('auth');
// Route::get('/data-nc/excel', [NcController::class, 'excel'])->middleware('auth')->name('excel-nc');

// Route::get('/data-nc/print/{nc:id_nc}', [NcController::class, 'print'])->middleware('auth');

Route::get('/data-ncr', [NcrController::class, 'index'])->middleware('auth')->name('data-ncr');
// Route::get('/data-ncr/add', [NcrController::class, 'index_add'])->middleware('auth');
Route::post('/data-ncr/add', [NcrController::class, 'store_add'])->middleware('auth');
Route::get('/data-ncr/form/{ncr:id_ncr}', [NcrController::class, 'index_form_ncr'])->middleware('auth');
Route::post('/data-ncr/form/{ncr:id_ncr}', [NcrController::class, 'store_form_ncr'])->middleware('auth');
Route::get('/data-ncr/edit/{ncr:id_ncr}', [NcrController::class, 'index_edit'])->middleware('auth');
// Route::post('/data-ncr/edit/{ncr:id_ncr}', [NcrController::class, 'store_edit'])->middleware('auth');
Route::get('/data-ncr/delete/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'delete'])->middleware('auth');
Route::get('/data-ncr/tlncr/input/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'index_tlncr'])->middleware('auth');
Route::post('/data-ncr/tlncr/input/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'store_tlncr'])->middleware('auth');
Route::get('/data-ncr/tlncr/view/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'view_tlncr'])->middleware('auth');
Route::get('/data-ncr/excel', [NcrController::class, 'excel'])->middleware('auth')->name('data-ncr.excel');
Route::delete('data-ncr/{ncr:id}', [NcrController::class, 'destroy'])->name('data-ncr.destroy');

Route::resource('data-ncr', NcrController::class)->middleware('auth');

Route::get('/data-ncr/print/{ncr:id}', [NcrController::class, 'print'])->middleware('auth');

Route::get('/data-ofi', [OfiController::class, 'index'])->middleware('auth')->name('data-ofi');
Route::get('/data-ofi/add', [OfiController::class, 'index_add'])->middleware('auth');
Route::post('/data-ofi/add', [OfiController::class, 'store_add'])->middleware('auth');
Route::get('/data-ofi/form/{ofi:id_ofi}', [OfiController::class, 'index_form_ofi'])->middleware('auth');
Route::post('/data-ofi/form/{ofi:id_ofi}', [OfiController::class, 'store_form_ofi'])->middleware('auth');
Route::get('/data-ofi/edit/{ofi:id_ofi}', [OfiController::class, 'index_edit'])->middleware('auth');
Route::post('/data-ofi/edit/{ofi:id_ofi}', [OfiController::class, 'store_edit'])->middleware('auth');
Route::get('/data-ofi/delete/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'delete'])->middleware('auth');
Route::get('/data-ofi/tlofi/input/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'index_tlofi'])->middleware('auth');
Route::post('/data-ofi/tlofi/input/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'store_tlofi'])->middleware('auth');
Route::get('/data-ofi/tlofi/view/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'view_tlofi'])->middleware('auth');
Route::get('/data-ofi/excel', [OfiController::class, 'excel'])->middleware('auth')->name('data-ofi.excel');
Route::resource('data-ofi', OfiController::class);
// Route::get('/data-ofi/{id}/lampiran', [OfiController::class, 'showLampiranModal'])->middleware('auth')->name('ofi.lampiran');

// Route delete data ofi
Route::delete('data-ofi/{ofi:id}', [OfiController::class, 'destroy'])->name('data-ofi.destroy');

// Route update data auditor ofi
Route::put('/data-ofi/{ofi:id_ofi}/tl/admin', [OfiController::class, 'update_tl_admin'])->middleware('auth')->name('ofi.update_tl_admin');

// Route create and update data validasi wakil manajemen ofi
Route::put('data-ofi/{ofi:id_ofi}/penerbitan/wm/', [OfiController::class, 'update_penerbitan_wm'])->middleware('auth')->name('ofi.update_penerbitan_wm');

// Route create and update data penerbitan auditee ofi
Route::put('data-ofi/{ofi:id_ofi}/penerbitan/auditor/', [OfiController::class, 'update_auditor'])->middleware('auth')->name('ofi.update_auditor');

// Route create and update data tl auditee ofi
Route::put('/data_ofi/{ofi:id_ofi}/tl/auditee/', [OfiController::class, 'update_auditee'])->middleware('auth')->name('ofi.update_auditee');

// Route create and update data verifikasi wm ofi
Route::put('/data-ofi/{ofi:id_ofi}/tl/wm', [OfiController::class, 'update_tl_wm'])->middleware('auth')->name('ofi.update_tl_wm');

// Route create and update data penerbitan admin ofi
Route::put('/data-ofi/{ofi:id_ofi}/penerbitan/admin', [OfiController::class, 'update_penerbitan_admin'])->middleware('auth')->name('ofi.update_penerbitan_admin');

Route::get('/data-ofi/print/{ofi:id}', [OfiController::class, 'print'])->middleware('auth');

Route::get('/data-ofi/{ofi:id_ofi}/submit_auditor', [App\Http\Controllers\OfiController::class, 'submit_auditor'])->name('data-ofi.submit_auditor');
Route::post('/data-ofi/{ofi:id_ofi}/submit_auditor', [App\Http\Controllers\OfiController::class, 'submit_auditor']);

Route::get('/data-ofi/{ofi:id_ofi}/release', [App\Http\Controllers\OfiController::class, 'release'])->name('data-ofi.release');
Route::post('/data-ofi/{ofi:id_ofi}/release', [App\Http\Controllers\OfiController::class, 'release']);

Route::get('/data-ofi/{ofi:id_ofi}/open', [App\Http\Controllers\OfiController::class, 'open'])->name('data-ofi.open');
Route::post('/data-ofi/{ofi:id_ofi}/open', [App\Http\Controllers\OfiController::class, 'open']);

Route::get('/data-ofi/{ofi:id_ofi}/submit', [App\Http\Controllers\OfiController::class, 'submit'])->name('data-ofi.submit');
Route::post('/data-ofi/{ofi:id_ofi}/submit', [App\Http\Controllers\OfiController::class, 'submit']);

Route::get('/data-ofi/{ofi:id_ofi}/submit_admin', [App\Http\Controllers\OfiController::class, 'submit_admin'])->name('data-ofi.submit_admin');
Route::post('/data-ofi/{ofi:id_ofi}/submit_admin', [App\Http\Controllers\OfiController::class, 'submit_admin']);

Route::get('/data-ofi/{ofi:id_ofi}/close_wm', [App\Http\Controllers\OfiController::class, 'close_wm'])->name('data-ofi.close_wm');
Route::post('/data-ofi/{ofi:id_ofi}/close_wm', [App\Http\Controllers\OfiController::class, 'close_wm']);

Route::get('/monitoring-tl', [MonitoringTLController::class, 'index'])->middleware('auth');
Route::get('/monitoring-tl/excel', [MonitoringTLController::class, 'excel'])->middleware('auth');

Route::get('/data-departemen', [DepartemenController::class, 'index'])->middleware('auth')->name('data-departemen');
Route::get('/data-departemen/add', [DepartemenController::class, 'index_add'])->middleware('auth')->name('data-departemen-add');
Route::post('/data-departemen/add', [DepartemenController::class, 'store_add'])->middleware('auth');
Route::get('/data-departemen/edit/{user}', [DepartemenController::class, 'index_edit'])->middleware('auth')->name('data-departemen-edit');
Route::post('/data-departemen/edit/{user}', [DepartemenController::class, 'store_edit'])->middleware('auth');
Route::get('/data-departemen/delete/{user}', [DepartemenController::class, 'delete'])->middleware('auth');

Route::resource('tema', TemaController::class);

Route::resource('user', UserController::class);

Route::post('data-ncr.approveAdmin/{ncr:id}', [NcrController::class, 'approveAdmin'])->middleware('auth')->name('data-ncr.approveAdmin');
Route::put('/data-ncr/{ncr}/updatencr_auditee', [NcrController::class, 'updateNcrAuditee'])->name('data-ncr.updatencr_auditee');
Route::post('data-ncr.approveAuditee/{ncr:id}', [NcrController::class, 'approveAuditee'])->middleware('auth')->name('data-ncr.approveAuditee');
Route::put('/data-ncr/{ncr}/updatencr_auditee2', [NcrController::class, 'updateNcrAuditee2'])->name('data-ncr.updatencr_auditee2');
Route::post('data-ncr.approveAuditee2/{ncr:id}', [NcrController::class, 'approveAuditee2'])->middleware('auth')->name('data-ncr.approveAuditee2');
Route::put('/data-ncr/{ncr}/updatencr_auditor2', [NcrController::class, 'updateNcrAuditor2'])->name('data-ncr.updatencr_auditor2');
Route::post('data-ncr.approveAuditor2/{ncr:id}', [NcrController::class, 'approveAuditor2'])->middleware('auth')->name('data-ncr.approveAuditor2');
Route::put('/data-ncr/{ncr}/updatencr_wm', [NcrController::class, 'updateNcrWM'])->name('data-ncr.updatencr_wm');
Route::post('data-ncr.approvewm/{ncr:id}', [NcrController::class, 'approveWM'])->middleware('auth')->name('data-ncr.approvewm');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
});

//usulan pengembangan 
Route::get('/faq', [FAQController::class, 'index'])->name('faq.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/cat', [CATController::class, 'index'])->name('cat.index');
    Route::post('/cat', [CATController::class, 'store'])->name('cat.store');
});

// Route untuk menampilkan form CAT
Route::get('/cat/add', [CATController::class, 'add'])->middleware('auth')->name('cat.add');
Route::get('/cat/{id}', [CATController::class, 'show'])->middleware('auth')->name('cat.show');
Route::get('/cat/{id}/edit', [CATController::class, 'edit'])->middleware('auth')->name('cat.edit');
Route::put('/cat/{id}', [CATController::class, 'update'])->middleware('auth')->name('cat.update');
Route::delete('/cat/{id}', [CATController::class, 'destroy'])->middleware('auth')->name('cat.destroy');
Route::get('/cat/export/excel', [App\Http\Controllers\CATController::class, 'exportExcel'])->name('cat.exportExcel');




Route::get('/hubungi', [HubungiController::class, 'index'])->name('hubungi.index');
