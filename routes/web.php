<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\holiday\EmployeeHolidayController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\SuperAdmin\Roles\{PermissionController, RoleController};
use App\Http\Controllers\SuperAdmin\Profile\ProfileController;
use App\Http\Controllers\SuperAdmin\SettingController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Login Routes (يدويًا - مهم جدًا)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('main.login');

    // SuperAdmin
    Route::prefix('superadmin')
        ->middleware(['auth', 'superadmin'])
        ->group(function () {
            // ================================ Department Routes =======================================//
            Route::get('dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
            Route::get('all-departments', [SuperAdminController::class, 'get_all_departments'])->name('get.all.departments');
            Route::get('get_department/{id}', [SuperAdminController::class, 'get_one_department'])->name('get.department');
            Route::post('add_department', [SuperAdminController::class, 'add_department'])->name('add.department');
            Route::get('create_department', [SuperAdminController::class, 'create_department'])->name('create.department');
            Route::post('update_department/{id}', [SuperAdminController::class, 'update_department'])->name('update.department');
            Route::post('delete_department/{id}', [SuperAdminController::class, 'delete_department'])->name('delete.department');
            // ================================ End Department Routes =======================================//


            //============================ Emlpoyee Routes ==============================================================//
            Route::get('all-employees', [SuperAdminController::class, 'get_all_employees'])->name('get.all.employees');
            Route::get('show_emloyee_date/{id}', [SuperAdminController::class, 'show_employee'])->name('show_employee_data');
            Route::post('add_employee', [SuperAdminController::class, 'add_employee'])->name('add.employee');
            Route::get('get_create_department', [SuperAdminController::class, 'get_create_employee'])->name('get.create.employee');
            Route::get('Edit_emlpoyee/{id}', [SuperAdminController::class, 'edit_employee'])->name('edit_employee');
            Route::post('Delete_emlpoyee/{id}', [SuperAdminController::class, 'delete_employee'])->name('delete.employee');
            Route::post('update_emlpoyee/{id}', [SuperAdminController::class, 'update_employee'])->name('update.employee');
            //=========================== End Employee Routes ============================================================//


            //============================ Attendences Routes ============================================================//
            Route::get('all-present-employees', [SuperAdminController::class, 'get_all_present_employees'])->name('present.employee');
            Route::get('all-absent-employees', [SuperAdminController::class, 'get_all_absent_employees'])->name('absent.employees');
            Route::get('all-lats-employees', [SuperAdminController::class, 'get_all_lats_employees'])->name('lats.employee');
            Route::get('attendance/report', [SuperAdminController::class, 'report'])->name('attendance.report');
            Route::get('attendance/report/export', [SuperAdminController::class, 'export'])->name('attendance.report.export');
            //=========================== End Attendences Routes =========================================================//


            //=============================== Leaves Routes =============================================================//
            Route::get('all_leaves_data', [SuperAdminController::class, 'get_all_leaves'])->name('all.leaves');
            Route::post('leave/{id}/approve', [SuperAdminController::class, 'approve_leaves'])->name('admin.leave.approve');
            Route::post('leave/{id}/reject', [SuperAdminController::class, 'reject_leaves'])->name('admin.leave.reject');
            Route::Post('delete_leaves/{id}', [SuperAdminController::class, 'delete_all_leaves'])->name('delete.all.leaves');
            //=============================== End Leaves Routes =============================================================//

            // ============================== Roles And Permissions ====================================================//
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
            // ============================== End Roles And Permissions ====================================================//

            //==================================== SuperAdmin EmployeeHolidays Routes =======================================================//
            Route::get('All_Employees_holidays', [SuperAdminController::class, 'get_all_employee_holidays'])->name('get.all_employee.holidays');
             Route::post('holiday/{id}/approve', [SuperAdminController::class, 'approve'])->name('holiday.admin.approve');
            Route::post('holiday/{id}/reject', [SuperAdminController::class, 'reject'])->name('holiday.admin.reject');
            Route::Post('delete_holiday/{id}', [SuperAdminController::class, 'delete_admin_holiday'])->name('delete.all_admin.holiday');

            //==================================== End SuperAdmin EmployeeHolidays Routes =======================================================//

            // ================================ Profile ==============================================================//
            Route::get('superadmin-profile', [ProfileController::class, 'get_profile_data'])->name('get.profile');
            Route::post('update-superadmin-profile/{id}', [ProfileController::class, 'update_profile'])->name('update.profile');
            //================================ End Profile Routes ==========================================================//

            //================================== Settings Routes ==============================================================//
            Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
            Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
            //=========================================== End Settings Routes ===================================================//
        });

    // Admin
    Route::prefix('admin')
        ->middleware(['auth', 'admin'])
        ->group(function () {
            Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
            //========================== Departments Routes ================================================//
            Route::get('get_department', [AdminController::class, 'get_department'])->name('get.admin.department');
            //========================== End Departments Routes ================================================//

            //========================== Employee Routes ================================================//
            Route::get('get_employees', [AdminController::class, 'get_department_employees'])->name('get.department.employees');
            Route::get('show_emloyee_date/{id}', [AdminController::class, 'show_employee'])->name('show_employee_department_data');
            //========================== End Employee Routes ================================================//

            //============================ Attendences Routes ============================================================//
            Route::get('all-present-employees', [AdminController::class, 'get_all_present_employees'])->name('admin.present.employee');
            Route::get('all-absent-employees', [AdminController::class, 'get_all_absent_employees'])->name('admin.absent.employees');
            Route::get('all-lats-employees', [AdminController::class, 'get_all_lats_employees'])->name('admin.lats.employee');
            Route::get('attendance/report', [AdminController::class, 'report'])->name('admin.attendance.report');
            Route::get('attendance/report/export', [AdminController::class, 'export'])->name('admin.attendance.report.export');
            //=========================== End Attendences Routes =========================================================//


            //=============================== Leaves Routes =============================================================//
            Route::get('all_leaves_data', [AdminController::class, 'get_all_leaves'])->name('admin.all.leaves');
            Route::get('get_admin_leaves', [AdminController::class, 'get_admin_leaves'])->name('admin.admin.leaves');
            Route::get('Form_Creation', [AdminController::class, 'get_form_creation'])->name('get.form.leave');
            Route::post('create_leave', [AdminController::class, 'create_leave'])->name('admin.leave');
            Route::get('Edit_Admin_leave/{id}', [AdminController::class, 'edit_admin_leave'])->name('admin.edit.leave');
            Route::post('update_admin_leave/{id}', [AdminController::class, 'update_admin_leave'])->name('update.admin.leave');
            Route::post('delete_admin_leave/{id}', [AdminController::class, 'delete_admin_leave'])->name('delete.admin.leave');
            Route::post('leave/{id}/approve', [AdminController::class, 'approve'])->name('leave.approve');
            Route::post('leave/{id}/reject', [AdminController::class, 'reject'])->name('leave.reject');
             Route::Post('delete_leave/{id}', [AdminController::class, 'delete_employee_leave'])->name('delete.employee.leave');
            //=============================== End Leaves Routes =============================================================//


            //==================================== EmployeeHolidays Routes =======================================================//
            Route::get('Admin_holidays', [EmployeeHolidayController::class, 'get_admin_holidays'])->name('get.admin.holidays');
            Route::get('offical_holidays', [EmployeeHolidayController::class, 'get_official_holidays'])->name('get.offical.holidays');
            Route::post('holiday/{id}/approve', [EmployeeHolidayController::class, 'approve'])->name('holiday.employee.approve');
            Route::post('holiday/{id}/reject', [EmployeeHolidayController::class, 'reject'])->name('holiday.employee.reject');
            // Route::get('holiday/{id}/edit',[EmployeeHolidayController::class, 'edit'])->name('edit.admin.holiday');
            Route::resource('holidays', EmployeeHolidayController::class);
            //==================================== End EmployeeHolidays Routes =======================================================//

            //================================== Register Attenedence Route ========================================================//
            Route::get('attendance', [AdminController::class, 'attendance_page'])
                ->name('admin.attendance.register');

            Route::post('attendance/checkin', [AdminController::class, 'attendance_checkin'])
                ->name('admin.attendance.checkin');

            Route::post('attendance/checkout', [AdminController::class, 'attendance_checkout'])
                ->name('admin.attendance.checkout');
                
            Route::get('/attendance-history', [AdminController::class, 'attendanceHistory'])->name('admin.attendance.history');

            //================================== End Register Attenedence Route ========================================================//


             // ================================ Profile ==============================================================//
            Route::get('admin-profile', [ProfileController::class, 'get_profile_admin'])->name('get.admin.profile');
            Route::post('update-admin-profile/{id}', [ProfileController::class, 'update_profile_admin'])->name('update.admin.profile');
            //================================ End Profile Routes ==========================================================//

        });

    // Employee
    Route::prefix('employee')
        ->middleware(['auth', 'employee'])
        ->group(function () {
            Route::get('dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');

            //================================== Department Employee ======================================//
            Route::get('get_employee_department',[EmployeeController::class,'get_employee_department'])->name('get.employee.department');
            //=================================== End Department Routes =========================================//


            //================================== Attenedence Employee ======================================//
             Route::get('/attendance-history', [EmployeeController::class, 'attendance_employee_history'])->name('employee.attendance.history');
            //================================== End Register Attenedence Route ========================================================//

            //=============================== Leaves Routes =============================================================//
            Route::get('all_leaves_data', [EmployeeController::class, 'get_employee_leaves'])->name('employee.all.leaves');
            Route::get('Form_Creation', [EmployeeController::class, 'get_form_creation'])->name('employee.form.leave');
            Route::post('create_leave', [EmployeeController::class, 'create_leave'])->name('employee.leave');
            Route::get('Edit_employee_leave/{id}', [EmployeeController::class, 'edit_employee_leave'])->name('employee.edit.leave');
            Route::post('update_employee_leave/{id}', [EmployeeController::class, 'update_employee_leave'])->name('update.employee.leave');
            Route::post('delete_employee_leave/{id}', [EmployeeController::class, 'delete_employee_leave'])->name('delete.employee.leave');
            //=============================== End Leaves Routes =============================================================//


             //==================================== Employee EmployeeHolidays Routes =======================================================//
            Route::get('Employee_holidays', [EmployeeController::class, 'get_employee_holidays'])->name('get.employee.holidays');
            Route::get('offical_holidays', [EmployeeController::class, 'get_employee_official_holidays'])->name('get.employee.offical.holidays');
            Route::get('Get_Form_creation', [EmployeeController::class, 'get_creation_form'])->name('get.employee.creation.form');
            Route::post('create_holiday', [EmployeeController::class, 'create_holiday'])->name('create.employee.holiday');
            Route::get('Edit_holiday/{id}', [EmployeeController::class, 'edit_employee_holiday'])->name('edit.employee.holiday');
            Route::Post('update_holiday/{id}', [EmployeeController::class, 'update_employee_holiday'])->name('update.employee.holiday');
            Route::Post('delete_holiday/{id}', [EmployeeController::class, 'delete_employee_holiday'])->name('delete.employee.holiday');

            //==================================== End Employee EmployeeHolidays Routes =======================================================//

            // ================================ Profile ==============================================================//
            Route::get('employee-profile', [ProfileController::class, 'get_profile_employee'])->name('get.employee.profile');
            Route::post('update-employee-profile/{id}', [ProfileController::class, 'update_profile_employee'])->name('update.employee.profile');
            //================================ End Profile Routes ==========================================================//



        });

});
