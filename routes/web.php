<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Posts;
use App\Livewire\PatientInfo;
use App\Livewire\PatientCreateForm;
use App\Livewire\PatientEditForm;
use App\Livewire\PatientView;
use App\Livewire\Dashboard;
use App\Livewire\NoteTracking;
use App\Livewire\NoteTrackingRecord;
use App\Livewire\Auth\ApiLogin;

Route::get('/', function () {
    return redirect()->route(session()->has('user') ? 'dashboard' : 'api.login');
});

Route::middleware(['api.auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/notes/create', NoteTracking::class)->name('notes.create');
    Route::get('/notes/record', NoteTrackingRecord::class)->name('notes.record');
});


Route::get('posts', Posts::class)->middleware('auth');
Route::get('patient_infos', PatientInfo::class)->middleware('auth')->name('patient.list');
Route::get('/patient/create', PatientCreateForm::class)->middleware(['auth'])->name('patient.create');
Route::get('/patient/view/{id}', PatientView::class)->middleware(['auth'])->name('patient.view');
Route::get('/patient/edit/{id}', PatientEditForm::class)->middleware(['auth'])->name('patient.edit');



Route::get('/api-login', ApiLogin::class)->name('api.login');


Route::get('/logout_api', function () {
    Session::flush();
    return redirect()->route('api.login');
})->name('logout_api');
