<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController as Invoice;
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
    return view('welcome');
});
 Route::prefix('invoices')->group(function(){
        Route::get('list',[Invoice::class, 'index'])->name('invoices.list');
        Route::get('create',[Invoice::class, 'create'])->name('invoices.create');
        Route::post('store',[Invoice::class, 'store'])->name('invoices.store');
        });

