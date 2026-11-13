<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute login sementara agar tidak error
Route::get('/login', function () {
    return 'Silakan login terlebih dahulu';
})->name('login');

Route::get('/mahasiswa/dashboard', function () {
    return 'Ini halaman khusus Mahasiswa';
})->middleware(['auth', 'role:mahasiswa']);

Route::get('/dosen/dashboard', function () {
    return 'Ini halaman khusus Dosen Wali';
})->middleware(['auth', 'role:dosen_wali']);

Route::get('/kaprodi/dashboard', function () {
    return 'Ini halaman khusus Kaprodi';
})->middleware(['auth', 'role:kaprodi']);

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Rute login instan untuk pengujian
Route::get('/login-mahasiswa', function () {
    $user = User::firstOrCreate(
        ['email' => 'mahasiswa@campus.com'],
        ['name' => 'Nisa Mahasiswa', 'password' => bcrypt('password'), 'role' => 'mahasiswa']
    );
    Auth::login($user);
    return 'Berhasil login sebagai Mahasiswa! Silakan buka: <a href="/mahasiswa/dashboard">/mahasiswa/dashboard</a>';
});

Route::get('/login-dosen', function () {
    $user = User::firstOrCreate(
        ['email' => 'dosen@campus.com'],
        ['name' => 'Pak Dosen', 'password' => bcrypt('password'), 'role' => 'dosen_wali']
    );
    Auth::login($user);
    return 'Berhasil login sebagai Dosen Wali! Silakan buka: <a href="/dosen/dashboard">/dosen/dashboard</a>';
});