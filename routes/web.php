<?php

use App\Models\Production;
use App\Http\Middleware\CekLogin;
use App\Http\Middleware\CekLogout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware(CekLogout::class);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name(name: 'register')->middleware(CekLogout::class);

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware(CekLogout::class);

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//operator-produksi
Route::get('/production/operator-produksi', [OperatorController::class, 'operator_view'])->name('operator-production');
Route::post('/production/operator-produksi', [OperatorController::class, 'save_report'])->name('create_report');

//leader
Route::get('/report-apporval', [LeaderController::class, 'leader_view'])->name('report_approval');
Route::get('/report-apporval/{id}', [LeaderController::class, 'detail'])->name('detail_report');
Route::get('/update-report/{id}', [LeaderController::class, 'update'])->name('edit_report');
Route::post('/report-apporval/{id}', [LeaderController::class, 'approve'])->name('report_approve');



//admin
Route::get('/production', action: [ProductionController::class, 'index'])->name(name: 'production.index')->middleware(CekLogin::class);
Route::get('/production/update/{id}', action: [ProductionController::class, 'update'])->name(name: 'updateProduction')->middleware(CekLogin::class);
Route::post('/production/create/{id}', action: [ProductionController::class, 'create'])->name(name: 'create_production')->middleware(CekLogin::class);
Route::put('/production/reject/{id}', action: [ProductionController::class, 'reject'])->name(name: 'reject_production')->middleware(CekLogin::class);

//laporan-bulanan
Route::get('/production-monthly', action: [ProductionController::class, 'reportMonthly'])->name(name: 'reportMonthly')->middleware(CekLogin::class);
Route::get('/production-monthly/generate/{bulan}', action: [ProductionController::class, 'generate'])->name(name: 'generate')->middleware(CekLogin::class);

Route::get('/monitoringGroup', action: [MonitoringController::class, 'index'])->name(name: 'monitoringGroup')->middleware(CekLogin::class);
Route::get('/monitoringGroup/generate/{bulan}', action: [MonitoringController::class, 'generate'])->name(name: 'generateDailyAchievement')->middleware(CekLogin::class);

Route::get('/dashboard/admin', action: [DashboardController::class, 'admin'])->name('dashboardadmin')->middleware(CekLogin::class);
Route::get('/dashboard/leader', action: [DashboardController::class, 'leader'])->name('dashboardLeader')->middleware(CekLogin::class);

Route::get('/userManagement', [UserController::class, 'index'])->name('userSettings')->middleware(CekLogin::class);
Route::post('/role/update-menus', [UserController::class, 'updateMenus'])->name('role.update.menus')->middleware(CekLogin::class);
Route::post('/user/update-role', [UserController::class, 'updateRole'])->name('user.update.role')->middleware(CekLogin::class);
Route::delete('/user/delete', [UserController::class, 'destroy'])->name('user.delete')->middleware(CekLogin::class);

// Route::get('/production/create', [ProductionController::class, 'create'])->name(name: 'addProduction');
// Route::post('/production', [ProductionController::class, 'create_report'])->name('create_production');

// Route::get('/productions/{id}', [ProductionController::class, 'show'])->name('showProduction');

// Route::get('/editProduction/{id}', [ProductionController::class, 'edit'])->name('editProduction');
// Route::put('/updateProduction/{id}', [ProductionController::class, 'update'])->name('updateProduction');

// Route::delete('/deleteProduction/{id}', [ProductionController::class, 'destroy'])->name('deleteProduction');
