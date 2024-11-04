<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController as UserLoginController; // สำหรับผู้ใช้ทั่วไป
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController; // สำหรับ admin
use App\Http\Controllers\AdminController;



Route::get('auth/callback', [AdminLoginController::class, 'callbackYRUPassport'])->name('auth.callbackYRUPassport');
Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');


Route::resource('activities', ActivityController::class);
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::get('/activities/{id}/registrations', [RegistrationController::class, 'showRegistrations'])->name('activities.showRegistrations');
Route::get('/activities/{id}/some-function', [ActivityController::class, 'someFunction'])->name('activities.someFunction');


// เส้นทางสำหรับผู้ใช้ทั่วไป
Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserLoginController::class, 'login']);
Route::post('logout', [UserLoginController::class, 'logout'])->name('logout');



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');


Route::middleware(['auth'])->group(function () {
    Route::get('/registrations/results', [RegistrationController::class, 'results'])->name('registrations.results');
});


Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
Route::get('/registrations/create/{activity}', [RegistrationController::class, 'create'])->name('registrations.create');
Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
Route::put('/registrations/{activityId}', [RegistrationController::class, 'update'])->name('registrations.update');


  


Route::get('/certificate/admin', [CertificateController::class, 'admin'])->name('certificate.admin');
Route::post('/certificate/update', [CertificateController::class, 'update'])->name('certificate.update');
// เส้นทางสำหรับดาวน์โหลดเกียรติบัตรเข้าร่วม


Route::get('/certificates/participate/{id}', [CertificateController::class, 'participate'])->name('certificates.participate');
Route::get('/certificates/template/{id}', [CertificateController::class, 'download'])->name('certificates.template');



Route::get('certificates', [CertificateController::class, 'index'])->name('certificates.index');





Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');



Route::get('/admin/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/admin/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');

// เส้นทางที่ใช้เพื่อแสดงฟอร์มติดต่อ
Route::get('/contact', [ContactController::class, 'create'])->name('contact.form');
// เส้นทางที่ใช้เพื่อส่งฟอร์มติดต่อ
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');

// เส้นทางสำหรับพิมพ์ใบลงทะเบียน
Route::get('/activity/{activityId}/generate-registration-pdf', [PDFController::class, 'generateRegistrationPDF'])->name('generate.registration.pdf');

// เส้นทางสำหรับพิมพ์ใบผลการแข่งขัน (ควรใช้ชื่อ route ที่ไม่ซ้ำ)
Route::get('/activity/{activityId}/generate-results-pdf', [PDFController::class, 'generateResultsPDF'])->name('generate.results.pdf');

Route::get('/activity/{activityId}/generate-registration-results-pdf', [PDFController::class, 'generateRegistrationResultsPDF'])->name('generate.result.pdf');









Route::get('/', function () {
    return view('welcome');
});

