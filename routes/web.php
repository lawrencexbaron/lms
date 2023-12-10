<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sections/getsections', [SectionController::class, 'getSections'])->name('section.getSections');
Route::get('/enroll-now', [EnrollController::class, 'enroll'])->name('enroll.index');

Route::post('/enroll', [EnrollController::class, 'enrollPost'])->name('enroll.post');
Route::get('/enroll/success/{id}', [EnrollController::class, 'EnrollSuccess'])->name('enroll.success');
Route::get('/enrolled/students', [EnrollController::class, 'EnrolledStudents'])->name('enrolled.students');
Route::get('/getgrades', [GradeLevelController::class, 'GetGrades'])->name('grades');
Route::get('/getsettings', [SettingsController::class, 'getSetting'])->name('settings');
Route::get('/sections/export/excel', [SectionController::class, 'exportExcel'])->name('section.export-exel');
Route::get('/sections/export/pdf', [SectionController::class, 'exportPDF'])->name('section.export-pdf');

Route::get('/getstatistics', [ReportController::class, 'getStatistics'])->name('statistics.getreport');


Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Section Routes
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/sections/create', [SectionController::class, 'create'])->name('section.create');
    Route::post('/sections/store', [SectionController::class, 'store'])->name('section.store');
    Route::delete('/sections/delete/{section}', [SectionController::class, 'destroy'])->name('section.delete');
    Route::get('/sections/edit/{section}', [SectionController::class, 'edit'])->name('section.edit');
    Route::put('/sections/update/{section}', [SectionController::class, 'update'])->name('section.update');
    Route::get('/sections/{section}', [SectionController::class, 'show'])->name('section.show');
    Route::get('/sections/view/{section}', [SectionController::class, 'SectionsView'])->name('section.view');
    // Route::get('/sections/getsections', [SectionController::class, 'getSections'])->name('section.getSections');
    

    // Student Routes
    Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::post('/student/{student}/update', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');

    // Room Routes
    Route::get('/grades/rooms', [GradeLevelController::class, 'index'])->name('graderoom.index');
    Route::get('/rooms/create', [GradeLevelController::class, 'CreateRoom'])->name('room.create');
    Route::post('/rooms/store', [GradeLevelController::class, 'StoreRoom'])->name('room.store');
    Route::get('/rooms/getrooms', [GradeLevelController::class, 'GetRooms'])->name('room.getrooms');
    Route::delete('/rooms/delete/{room}', [GradeLevelController::class, 'DeleteRoom'])->name('room.delete');
    Route::get('/rooms/edit/{room}', [GradeLevelController::class, 'EditRoom'])->name('room.edit');
    Route::put('/rooms/update/{room}', [GradeLevelController::class, 'UpdateRoom'])->name('room.update');

    // Grade Level Routes
    Route::get('/grades/create', [GradeLevelController::class, 'CreateGradeLevel'])->name('grade.create');
    Route::post('/grades/store', [GradeLevelController::class, 'StoreGradeLevel'])->name('grade.store');
    Route::get('/grades/getgrades', [GradeLevelController::class, 'GetGradeLevels'])->name('grade.getgrades');
    Route::delete('/grades/delete/{grade}', [GradeLevelController::class, 'DeleteGradeLevel'])->name('grade.delete');
    Route::get('/grades/edit/{grade}', [GradeLevelController::class, 'EditGradeLevel'])->name('grade.edit');
    Route::put('/grades/update/{grade}', [GradeLevelController::class, 'UpdateGradeLevel'])->name('grade.update');

    // Enroll Routes
    Route::get('/enrolled', [EnrollController::class, 'enrolled'])->name('enrolled.index');
    // Route::get('/enrolled/students/{id}', [EnrollController::class, 'EnrolledStudents'])->name('enrolled.students');
    Route::get('/enrolled/students/view/{id}', [EnrollController::class, 'EnrolledStudentsView'])->name('enrolled.students.view');
    
    // Route::post('/enroll', [EnrollController::class, 'enrollPost'])->name('enroll.post');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
