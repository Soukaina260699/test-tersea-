<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuth ;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckEmployeeProfile;
use App\Http\Middleware\IsGuest;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Middleware\AuditMiddleware;

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


Route::prefix('admin')->group(function () {
    Route::middleware([IsGuest::class])->group(function () {
        Route::get('/login', [AdminAuth::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuth::class, 'login']);
    });

    Route::middleware([Authenticate::class])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuth::class, 'logout'])->name('admin.logout');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/create', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/data', [AdminController::class, 'getData'])->name('admin.data');

    });
});

Route::prefix('societe')->group(function () {
    Route::middleware([Authenticate::class])->group(function () {
        Route::get('/', [SocieteController::class, 'index'])->name('societes.index');
        Route::post('/', [SocieteController::class, 'store'])->name('societes.store');
        Route::get('/{societe}/edit', [SocieteController::class, 'edit'])->name('societes.edit');
        Route::put('/{societe}', [SocieteController::class, 'update'])->name('societes.update');
        Route::delete('/{societe}', [SocieteController::class, 'destroy'])->name('societes.destroy');
    });
});

Route::group([Authenticate::class], function () {
    Route::get('/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
    Route::delete('/invitations/{invite}', [InvitationController::class, 'destroy'])->name('invitations.destroy');
});

Route::get('/accepter/{token}',[InvitationController::class, 'accept'])->name('accepter');

Route::group([CheckEmployeeProfile::class], function () {
    Route::get('/complete-profile',[EmployeController::class, 'completeProfileForm'])->name('employee.complete_profile_form');
    Route::post('/complete-profile',[EmployeController::class, 'completeProfile'])->name('employee.complete_profile');
});

Route::group([AuditMiddleware::class], function () {
    Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');
});

