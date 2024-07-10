<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');

Route::get('/get/employee/', function () {
    return Employee::orderByDesc('id')->get();
});
Route::post('/store/employee', [EmployeeController::class, 'store']);
Route::get('/delete/employee/{id}', [EmployeeController::class, 'delete']);
