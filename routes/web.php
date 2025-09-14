<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.index');
    Route::get('/inventory', 'inventory')->name('admin.inventory');
    Route::get('/add-product', 'addProduct')->name('admin.addProduct');
    Route::get('/add-product-type', 'addProductType')->name('admin.addProductType');

});
