<?php

use App\Models\UserManagementModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Models\UserManagement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

//! dashboard or default page
Route::get('/', [UserManagementController::class, 'defaultPage']);


Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/adduser', [UserManagementController::class, 'addUser'])->name('addUser');
    Route::get('/displayUsers', [UserManagementController::class, 'displayUsers'])->name('displayUsers');
    Route::post('/updateUser',[ UserManagementController::class, 'updateUser'])->name('updateUser');
    Route::post('/deleteUser',[ UserManagementController::class, 'deleteUser'])->name('deleteUser');
   
});



