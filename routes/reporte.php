<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteMascotaController;
/*use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
Route::get('test', function () {
    $role = Role::create(['name' => 'writer']);
    $permission = Permission::create(['name' => 'edit articles']);
    $permission2 = Permission::create(['name' => 'edit2 articles']);
    $permission3 = Permission::create(['name' => 'edit3 articles']);
    $role->syncPermissions([$permission, $permission2, $permission3, $permission]);
    return "";
});*/
Route::resource('reporteMascota', ReporteMascotaController::class)->only(['index']);
Route::post('reporteMascota/report', [ReporteMascotaController::class, 'store'])->name('reporteMascota.report');
Route::post('reporteMascota/report/pdf', [ReporteMascotaController::class, 'pdf'])->name('reporteMascota.pdf');
