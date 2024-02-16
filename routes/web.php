<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;
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
Route::get('/', [FamilyController::class, 'details'])->name('details');

Route::get('/family/create', [FamilyController::class, 'create'])->name('family.create');
Route::post('/family', [FamilyController::class, 'store']);
Route::get('/family/details', [FamilyController::class, 'details'])->name('family.details');

Route::get('/family/{family_id}/member/', [FamilyMemberController::class, 'show'])->name('family.member.show');

Route::get('/family/{family_id}/create', [FamilyMemberController::class, 'create'])->name('family.member.create');
Route::post('/family/{family_id}/members', [FamilyMemberController::class, 'store'])->name('family.members.store');
