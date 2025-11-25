<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\InvoiceGeneratorController;
use App\Http\Controllers\Api\MeterController;
use App\Http\Controllers\Api\MeterReadingController;
use App\Http\Controllers\Api\PaymentController;

//Muestra todas las factura
Route::get('/invoices',[InvoiceController::class, 'index']);

//Muestra una factura
Route::get('/invoices/{invoice}',[InvoiceController::class, 'show']);

//Anula una factura
Route::delete('/invoices/{invoice}',[InvoiceController::class, 'destroy']);

//Paga una factura
Route::post('/invoices/{invoice}/payments',[PaymentController::class,'store']);

//Crear una factura
Route::post('/invoices/generate',[InvoiceGeneratorController::class,'store']);

//Muestra todos los medidores
Route::get('/meters', [MeterController::class,'index']);

//Muestra un medidor
Route::get('/meters/{meter}', [MeterController::class,'show']);

//Crea un medidor
Route::post('/meters', [MeterController::class,'store']);

//Actualiza el serial number, estado o la fecha de instalación de un medidor
Route::put('/meters/{meter}', [MeterController::class,'update']);

//Crear una lectura para un medidor
Route::post('/meters/{meter}/readings',[MeterReadingController::class,'store']);


