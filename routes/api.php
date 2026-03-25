<?php
// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DonationCategoryController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\EmailSettingController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\WireTransferController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

// login route
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

// donation categories routes
Route::get('donation-categories', [DonationCategoryController::class, 'index']);
Route::post('donation-categories', [DonationCategoryController::class, 'store']);
Route::get('donation-categories/show/{id}', [DonationCategoryController::class, 'show']);
Route::put('donation-categories/edit/{id}', [DonationCategoryController::class, 'update']);
Route::delete('donation-categories/{id}', [DonationCategoryController::class, 'destroy']);

// expense categories routes
Route::get('expense-categories', [ExpenseCategoryController::class, 'index']);
Route::post('expense-categories', [ExpenseCategoryController::class, 'store']);
Route::get('expense-categories/show/{id}', [ExpenseCategoryController::class, 'show']);
Route::put('expense-categories/edit/{id}', [ExpenseCategoryController::class, 'update']);
Route::delete('expense-categories/{id}', [ExpenseCategoryController::class, 'destroy']);

// payment methods rotes
Route::get('payment-methods', [PaymentMethodController::class, 'index']);
Route::post('payment-methods', [PaymentMethodController::class, 'store']);
// Route::get('payment-methods/show/{id}', [PaymentMethodController::class, 'show']);
Route::put('payment-methods/edit/{id}', [PaymentMethodController::class, 'update']);
Route::delete('payment-methods/{id}', [PaymentMethodController::class, 'destroy']);


// currency routes
Route::get('currencies', [CurrencyController::class, 'index']);
Route::post('currencies', [CurrencyController::class, 'store']);
Route::get('currencies/show/{id}', [CurrencyController::class, 'show']);
Route::put('currencies/edit/{id}', [CurrencyController::class, 'update']);
Route::delete('currencies/{id}', [CurrencyController::class, 'destroy']);


// email settings rotes
Route::get('email-settings/{id}', [EmailSettingController::class, 'edit']);
Route::put('email-settings/{id}', [EmailSettingController::class, 'update']);

// general settings routes
Route::get('general-settings/{id}', [GeneralSettingController::class, 'show']);
Route::put('general-settings/{id}', [GeneralSettingController::class, 'update']);

// bank accounts routes
Route::get('bank-accounts', [BankAccountController::class, 'index']);
Route::post('bank-accounts', [BankAccountController::class, 'store']);
Route::get('bank-accounts/show/{id}', [BankAccountController::class, 'show']);
Route::put('bank-accounts/edit/{id}', [BankAccountController::class, 'update']);
Route::delete('bank-accounts/{id}', [BankAccountController::class, 'destroy']);

// donation routes
Route::get('donations', [DonationController::class, 'index']);
Route::get('donations/create', [DonationController::class, 'create']);
Route::post('donations', [DonationController::class, 'store']);
Route::get('donations/show/{id}', [DonationController::class, 'show']);
Route::get('donations/edit/{id}', [DonationController::class, 'edit']);
Route::put('donations/update/{id}', [DonationController::class, 'update']);
Route::get('payment-methods', [PaymentMethodController::class, 'index']); // Dropdown
Route::get('donation-categories', [DonationCategoryController::class, 'index']); // Dropdown
Route::get('bank-accounts', [BankAccountController::class, 'index']); // Dropdown
Route::delete('donations/{id}', [DonationController::class, 'destroy']);

// wire transfers routes
Route::get('wire-transfers', [WireTransferController::class, 'index']);
Route::get('wire-transfers/create', [WireTransferController::class, 'create']);
Route::post('wire-transfers/store', [WireTransferController::class, 'store']);
Route::get('wire-transfers/edit/{id}', [WireTransferController::class, 'edit']);
Route::put('wire-transfers/update/{id}', [WireTransferController::class, 'update']);
Route::get('wire-transfers/show/{id}', [WireTransferController::class, 'show']);
Route::delete('wire-transfers/{id}', [WireTransferController::class, 'destroy']);

// expense routes
Route::get('expenses', [ExpensesController::class, 'index']);
Route::get('expenses/create', [ExpensesController::class, 'create']);
Route::post('expenses/store', [ExpensesController::class, 'store']);
Route::get('expenses/show/{id}', [ExpensesController::class, 'show']);
Route::get('expenses/edit/{id}', [ExpensesController::class, 'edit']);
Route::put('expenses/update/{id}', [ExpensesController::class, 'update']);
Route::delete('expenses/{id}', [ExpensesController::class, 'destroy']);

// role routes
Route::get('roles', [RoleController::class, 'index']);
Route::get('roles/create', [RoleController::class, 'create']);
Route::post('roles/store', [RoleController::class, 'store']);
Route::get('roles/show/{id}', [RoleController::class, 'show']);
Route::get('roles/edit/{id}', [RoleController::class, 'edit']);
Route::put('roles/update/{id}', [RoleController::class, 'update']);
Route::delete('roles/{id}', [RoleController::class, 'destroy']);

// permission role
Route::get('permissions', [PermissionController::class, 'index']);
Route::post('permissions/store', [PermissionController::class, 'store']);
Route::get('permissions/edit/{id}', [PermissionController::class, 'edit']);
// Route::get('/show/{id}', [PermissionController::class, 'show']);
Route::put('permissions/update/{id}', [PermissionController::class, 'update']);
Route::delete('permissions/delete/{id}', [PermissionController::class, 'destroy']);



Route::get('users', [UserController::class, 'index']);
Route::get('users/create', [UserController::class, 'create']);
Route::post('users/store', [UserController::class, 'store']);
Route::get('users/show/{id}', [UserController::class, 'show']);
Route::get('users/edit/{id}', [UserController::class, 'edit']);
Route::put('users/update/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

Route::post('/logout', [AuthController::class, 'logout']);
});





















