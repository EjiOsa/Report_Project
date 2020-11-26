<?php

use App\Http\Controllers\ReportListController;
use App\Http\Controllers\ReportMakeController;
use App\Http\Controllers\Ajax\AttachmentController;
use Illuminate\Support\Facades\Route;
// Authはconfig/app.phpの196行目で宣言されてるから使えるらしいけど、warningが気持ち悪いから記載。
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('top');
});

Route::get('/create', function () {
    return view('report_create/createReport');
})->middleware('auth');

// 報告書作成ルート
Route::post('/create', 'ReportCreateController@createReport');

Route::post('create/finish', 'ReportCreateController@insertReport');

Route::post('create/confirm', 'ReportCreateController@reportConfirm');

// 報告書一覧ルート
Route::get('/list','ReportListController@getReport');

Route::post('detail', 'ReportListController@reportDetail');

Route::get('narrow','ReportListController@getNarrowReport');

Route::post('narrow', 'ReportListController@reportNarrow');

// 以下、Auth追加時に自動で追加
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes([
    'verify'   => false, // メール確認機能（※5.7系以上のみ）
    'register' => false, // デフォルトの登録機能OFF
    'reset'    => false,  // メールリマインダー機能ON
]);

// ajax@attachment
Route::post('/create/ajax/attachment', [AttachmentController::class, 'delAttachment']);

// ファイルダウンロード
Route::post('download','DownloadController@downloadFile');
