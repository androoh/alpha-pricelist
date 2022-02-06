<?php

use App\Http\Controllers\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/resources', [Resource::class, 'resources']);
Route::get('/resources/{resourceName}/filters', [Resource::class, 'getFilters']);
Route::get('/resources/{resourceName}/info', [Resource::class, 'getResourceByName']);
Route::get('/resources/{resourceName}/list', [Resource::class, 'resourceList']);
Route::get('/resources/{resourceName}', [Resource::class, 'create']);
Route::get('/resources/{resourceName}/{id}', [Resource::class, 'edit']);
Route::get('/resources/{resourceName}/{id}/html', [\App\Http\Controllers\PagedMedia::class, 'renderResource']);
Route::post('/resources/{resourceName}', [Resource::class, 'store']);
Route::put('/resources/{resourceName}/{id}', [Resource::class, 'update']);
Route::delete('/resources/{resourceName}/{id}', [Resource::class, 'remove']);
Route::post('/files', [\App\Http\Controllers\File::class, 'uploadFile']);
Route::get('/files/{id}', [\App\Http\Controllers\File::class, 'getFileById'])->name('get_file_by_id');
Route::get('/files/n/{filename}', [\App\Http\Controllers\File::class, 'getFileByFilename'])->name('get_file_by_name');
Route::get('/html', [\App\Http\Controllers\PagedMedia::class, 'html']);
Route::post('/category/html', [\App\Http\Controllers\PagedMedia::class, 'category']);
Route::get('/prices/{priceListId}', [\App\Http\Controllers\Prices::class, 'index']);
Route::put('/prices/{priceListId}', [\App\Http\Controllers\Prices::class, 'store']);
