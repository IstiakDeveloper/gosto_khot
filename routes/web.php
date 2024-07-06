<?php

use App\Livewire\Dashboard;
use App\Livewire\HomeComponent;
use App\Livewire\MemberManagement;
use App\Livewire\PaymentManagement;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->name('home');

Route::get('/storage-link', function () {
    try {
        Artisan::call('storage:link');
        return "The [public/storage] directory has been linked.";
    } catch (\Exception $e) {
        return "There was an error: " . $e->getMessage();
    }
})->name('storage.link');

Route::middleware(['auth'])->group(function () {
    Route::get('/members', MemberManagement::class)->name('members');

    Route::get('/payments', PaymentManagement::class)->name('payments');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::get('/seeder', function () {
    Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SuperAdminUserSeeder']);
    return 'seeder ran successfully!';
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
