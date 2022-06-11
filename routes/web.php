<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; // step 1

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

// date_default_timezone_set('Asia/Karachi');
Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::post('/section', [App\Http\Controllers\FolderController::class, 'AddSection'])->name('add-section');

Route::get('/logout', [LoginController::class, 'logout']); // step 2

Route::get('/folder/index/{id}', [App\Http\Controllers\FolderController::class, 'index'])->name('folder-index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/folder', [App\Http\Controllers\FolderController::class, 'AddFolder'])->name('add-folder');

Route::get('/meta/index', [App\Http\Controllers\FolderController::class, 'MetaIndex'])->name('meta-index');

Route::post('/add-meta', [App\Http\Controllers\FolderController::class, 'AddMeta'])->name('add-meta');

// Route::get('/edit/meta/{id}', [App\Http\Controllers\FolderController::class, 'EditMeta'])->name('edit-meta');

Route::get('/delete/meta/{id}', [App\Http\Controllers\FolderController::class, 'DeleteMeta'])->name('delete-meta');

Route::post('/column-folder', [App\Http\Controllers\FolderController::class, 'ColumnFolder'])->name('add-column-folder');

// Route::post('/upload-image', [App\Http\Controllers\UploadController::class, 'postUploadForm']);

// Route::post('/dashboard/documents/store', 'DocumentController@store');

Route::post('/upload-files', [App\Http\Controllers\FolderController::class, 'fileUpload'])->name('image-upload');

Route::get('/file/view/{id}', [App\Http\Controllers\FileController::class, 'index'])->name('file-view');

Route::get('/file/edit/{id}', [App\Http\Controllers\FileController::class, 'EditView'])->name('edit-scan-file');

Route::post('/edit-form', [App\Http\Controllers\FileController::class, 'Editfile'])->name('edit-file-form');

Route::get('/move/file/{id}', [App\Http\Controllers\FileController::class, 'MoveFile'])->name('file-move');

Route::post('/lock/file', [App\Http\Controllers\FileController::class, 'LockFile'])->name('file-lock');

Route::post('/unlock/file', [App\Http\Controllers\FileController::class, 'UnlockFile'])->name('file-unlock');


Route::post('/file/update', [App\Http\Controllers\FileController::class, 'UpdateImageFile'])->name('file-update');




Route::get('meta', [App\Http\Controllers\FolderController::class, 'MetaRecord'])->name('meta-table');

Route::get('/download/file/{id}', [App\Http\Controllers\FileController::class, 'FileDownload'])->name('download-file');

Route::get('/search/index/{query}', [App\Http\Controllers\SearchController::class, 'SearchQuery'])->name('search-query');

Route::get('search', [App\Http\Controllers\SearchController::class, 'SearchRecord'])->name('search-table');

Route::post('/delete/file', [App\Http\Controllers\FileController::class, 'DeleteFile'])->name('file-delete');

Route::get('/folder/recycle-bin', [App\Http\Controllers\FolderController::class, 'RecycleView'])->name('recycle-bin');

Route::get('/recycle/table', [App\Http\Controllers\FolderController::class, 'RecycleData'])->name('recycle-data');

Route::get('/recycle/empty', [App\Http\Controllers\FolderController::class, 'EmptyRecyle'])->name('empty-recycle');

Route::post('/recycle/delete', [App\Http\Controllers\FolderController::class, 'DeletePermanent'])->name('permanent-delete');


Route::get('/restore/data', [App\Http\Controllers\FolderController::class, 'RestoreData'])->name('restore-data');

Route::get('/main/table', [App\Http\Controllers\FolderController::class, 'MainData'])->name('main-data');

Route::post('/edit/meta', [App\Http\Controllers\FolderController::class, 'EditMeta'])->name('edit-meta-form');

Route::post('/delete/meta', [App\Http\Controllers\FolderController::class, 'DeleteMeta'])->name('delete-meta');

Route::get('/account/report', [App\Http\Controllers\DashboardController::class, 'index'])->name('dash-index');

Route::get('proceed-invoice-order',[App\Http\Controllers\FolderController::class, 'OrderData'])->name('proceed-invoice-order');

Route::get('/account/users', [App\Http\Controllers\AccountController::class, 'index'])->name('manage-users');


Route::get('/folder-file/{id}', [App\Http\Controllers\FileController::class, 'FileFolderDownload'])->name('download-folder-file');

Route::post('/create/user', [App\Http\Controllers\AccountController::class, 'store'])->name('store-user');
Route::get('/account/audit', [App\Http\Controllers\AccountController::class, 'AuditView'])->name('audit-log');

Route::get('audit', [App\Http\Controllers\AccountController::class, 'AuditRecord'])->name('audit-table-data');

Route::get('/folder/audit/{id}', [App\Http\Controllers\AccountController::class, 'FolderAuditView'])->name('folder-audit');

Route::get('/approve/user', [App\Http\Controllers\ApprovalController::class, 'index'])->name('approve-users');

Route::post('/invite/user', [App\Http\Controllers\ApprovalController::class, 'InviteUser'])->name('invite-user');

Route::get('/notify/approvals', [App\Http\Controllers\ApprovalController::class, 'NotifyView'])->name('notify-files');

Route::get('/file/approval', [App\Http\Controllers\ApprovalController::class, 'fileapproval'])->name('file-approval-view');

Route::get('/user/data', [App\Http\Controllers\ApprovalController::class, 'UserData'])->name('user-invite-table');


Route::get('/report/{tabs}', [App\Http\Controllers\DashboardController::class, 'TabsFile'])->name('tabs-file');



Route::get('/resolution/view/{id}', [App\Http\Controllers\ApprovalController::class, 'ResoView'])->name('reso-view');

Route::get('/resolution/status/', [App\Http\Controllers\ApprovalController::class, 'ResoStatus'])->name('reso-status');

Route::post('get-duplicate', [App\Http\Controllers\DashboardController::class,'getDuplicate'])->name('excel-duplicate');

Route::post('/retention/', [App\Http\Controllers\FileController::class, 'FileRetention'])->name('file-retention');
 

Route::get('/delete/user', [App\Http\Controllers\ApprovalController::class, 'deleteUser'])->name('delete-user');

Route::get('/approval/history', [App\Http\Controllers\ApprovalController::class, 'ApprovalHistory'])->name('file-approval-history');







