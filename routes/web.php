<?php

use App\Http\Controllers\HubController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AiActivationController;
use Illuminate\Support\Facades\Route;

// Main Hub Routes
Route::get('/', [HubController::class, 'index'])->defaults('tab', 'lipika_workspace')->name('home');
Route::get('/store', [HubController::class, 'index'])->defaults('tab', 'marketplace')->name('store');
Route::get('/workspace', [HubController::class, 'index'])->defaults('tab', 'in_app_chat')->name('workspace');
Route::get('/proxy', [HubController::class, 'index'])->defaults('tab', 'domain_proxy')->name('proxy');
Route::get('/dashboard', [HubController::class, 'index'])->defaults('tab', 'customer_portal')->name('dashboard');
Route::get('/reseller', [HubController::class, 'index'])->defaults('tab', 'reseller_panel')->name('reseller');
Route::get('/vault', [HubController::class, 'index'])->defaults('tab', 'vault')->name('vault');
Route::get('/admin', [HubController::class, 'index'])->defaults('tab', 'super_admin')->name('admin');
Route::get('/guides', [HubController::class, 'index'])->defaults('tab', 'guides')->name('guides');

// One-Time AI Activation Link Public Routes
Route::get('/activate/{token}', [AiActivationController::class, 'show'])->name('ai.activate.show');
Route::post('/activate/{token}', [AiActivationController::class, 'activate'])->name('ai.activate.submit');

// Admin Endpoints for AI Master Keys & Link Generator
Route::post('/api/admin/generate-activation-link', [AiActivationController::class, 'generate'])->name('ai.activation.generate');
Route::post('/api/admin/save-master-ai-keys', [AiActivationController::class, 'saveMasterKeys'])->name('ai.activation.save-keys');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
