<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationCategoryController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\WireTransferController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\EmailSettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Spatie\Permission\Contracts\Permission;
// use App\Http\Controllers\API\AuthController;
// Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // // donation categories routes
    Route::get('donation-categories', [DonationCategoryController::class, 'index']);
    Route::get('donation-categories/create', [DonationCategoryController::class, 'create']);
    Route::post('donation-categories/store', [DonationCategoryController::class, 'store']);
    Route::get('donation-categories/edit/{id}', [DonationCategoryController::class, 'edit']);
    Route::put('donation-categories/update/{id}', [DonationCategoryController::class, 'update']);
    Route::get('donation-categories/delete/{id}', [DonationCategoryController::class, 'destroy']);
    Route::get('donation-categories/show/{id}', [DonationCategoryController::class, 'show']);

    // bank accounts routes
    Route::get('bank-accounts', [BankAccountController::class, 'index']);
    Route::get('bank-accounts/create', [BankAccountController::class, 'create']);
    Route::post('bank-accounts/store', [BankAccountController::class, 'store']);
    Route::get('bank-accounts/edit/{id}', [BankAccountController::class, 'edit']);
    Route::put('bank-accounts/update/{id}', [BankAccountController::class, 'update']);
    Route::get('bank-accounts/delete/{id}', [BankAccountController::class, 'destroy']);
    Route::get('bank-accounts/show/{id}', [BankAccountController::class, 'show']);

    // donations routes
    Route::get('donations', [DonationController::class, 'index']);
    Route::get('donations/create', [DonationController::class, 'create']);
    Route::post('donations/store', [DonationController::class, 'store']);
    Route::get('donations/edit/{id}', [DonationController::class, 'edit']);
    Route::put('donations/update/{id}', [DonationController::class, 'update']);
    Route::get('donations/delete/{id}', [DonationController::class, 'destroy']);
    Route::get('donations/show/{id}', [DonationController::class, 'show']);

    // expense categories routes
    Route::get('expense-categories', [ExpenseCategoryController::class, 'index']);
    Route::get('expense-categories/create', [ExpenseCategoryController::class, 'create']);
    Route::post('expense-categories/store', [ExpenseCategoryController::class, 'store']);
    Route::get('expense-categories/edit/{id}', [ExpenseCategoryController::class, 'edit']);
    Route::put('expense-categories/update/{id}', [ExpenseCategoryController::class, 'update']);
    Route::get('expense-categories/delete/{id}', [ExpenseCategoryController::class, 'destroy']);
    Route::get('expense-categories/show/{id}', [ExpenseCategoryController::class, 'show']);

    // wire transfers routes
    Route::get('wire-transfers', [WireTransferController::class, 'index']);
    Route::get('wire-transfers/create', [WireTransferController::class, 'create']);
    Route::post('wire-transfers/store', [WireTransferController::class, 'store']);
    Route::get('wire-transfers/edit/{id}', [WireTransferController::class, 'edit']);
    Route::put('wire-transfers/update/{id}', [WireTransferController::class, 'update']);
    // Route::get('wire-transfers/delete/{id}', [WireTransferController::class, 'destroy']);
    Route::delete('wire-transfers/delete/{id}', [WireTransferController::class, 'destroy']);
    Route::get('wire-transfers/show/{id}', [WireTransferController::class, 'show']);

    // expenses routes
    Route::get('expenses', [ExpensesController::class, 'index']);
    Route::get('expenses/create', [ExpensesController::class, 'create']);
    Route::post('expenses/store', [ExpensesController::class, 'store']);
    Route::get('expenses/edit/{id}', [ExpensesController::class, 'edit']);
    Route::put('expenses/update/{id}', [ExpensesController::class, 'update']);
    Route::get('expenses/delete/{id}', [ExpensesController::class, 'destroy']);
    Route::get('expenses/show/{id}', [ExpensesController::class, 'show']);

    // settings payment methods routes
    Route::get('payment-methods', [PaymentMethodController::class, 'index']);
    Route::get('payment-methods/create', [PaymentMethodController::class, 'create']);
    Route::post('payment-methods/store', [PaymentMethodController::class, 'store']);
    Route::get('payment-methods/edit/{id}', [PaymentMethodController::class, 'edit']);
    Route::put('payment-methods/update/{id}', [PaymentMethodController::class, 'update']);
    Route::get('payment-methods/delete/{id}', [PaymentMethodController::class, 'destroy']);
    Route::get('payment-methods/show/{id}', [PaymentMethodController::class, 'show']);

    // settings Currency Management routes
    Route::get('currencies', [CurrencyController::class, 'index']);
    Route::get('currencies/create', [CurrencyController::class, 'create']);
    Route::post('currencies/store', [CurrencyController::class, 'store']);
    Route::get('currencies/edit/{id}', [CurrencyController::class, 'edit']);
    Route::put('currencies/update/{id}', [CurrencyController::class, 'update']);
    Route::get('currencies/delete/{id}', [CurrencyController::class, 'destroy']);
    Route::get('currencies/show/{id}', [CurrencyController::class, 'show']);

    // general settings
    Route::get('general-settings/index/{id}', [GeneralSettingController::class, 'edit']);
    Route::put('general-settings/update/{id}', [GeneralSettingController::class, 'update']);

    // email settings routes
    Route::get('email-settings/index/{id}', [EmailSettingController::class, 'edit']);
    Route::put('email-settings/update/{id}', [EmailSettingController::class, 'update']);

    // users routes
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/create', [UserController::class, 'create']);
    Route::post('users/store', [UserController::class, 'store']);
    Route::get('users/edit/{id}', [UserController::class, 'edit']);
    Route::put('users/update/{id}', [UserController::class, 'update']);
    Route::get('users/delete/{id}', [UserController::class, 'destroy']);
    Route::get('users/show/{id}', [UserController::class, 'show']);

    // roles routes
    Route::get('roles', [RoleController::class, 'index']);
    Route::get('roles/create', [RoleController::class, 'create']);
    Route::post('roles/store', [RoleController::class, 'store']);
    Route::get('roles/edit/{id}', [RoleController::class, 'edit']);
    Route::put('roles/update/{id}', [RoleController::class, 'update']);
    Route::get('roles/delete/{id}', [RoleController::class, 'destroy']);
    Route::get('roles/show/{id}', [RoleController::class, 'show']);

    // permissions routes
    Route::get('permissions', [PermissionController::class, 'index']);
    Route::get('permissions/create', [PermissionController::class, 'create']);
    Route::post('permissions/store', [PermissionController::class, 'store']);
    Route::get('permissions/edit/{id}', [PermissionController::class, 'edit']);
    Route::put('permissions/update/{id}', [PermissionController::class, 'update']);
    Route::get('permissions/delete/{id}', [PermissionController::class, 'destroy']);

});

require __DIR__.'/auth.php';
