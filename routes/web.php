<?php

use Monolog\Registry;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\KreatorController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\subjectController;
use App\Http\Controllers\teacherController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\classroomController;
use App\Http\Controllers\violationController;
use App\Http\Controllers\competenceController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\YearsemesterController;
use App\Http\Controllers\dashboardGuruController;
use App\Http\Controllers\PanggilanOrtuController;
use App\Http\Controllers\changePasswordController;
use App\Http\Controllers\dashboardAdminController;
use App\Http\Controllers\dashboardSiswaController;
use App\Http\Controllers\dashboardKreatorController;
use App\Http\Controllers\dashboardGuruPiketController;
use App\Http\Controllers\dashboardLandingPageController;

// Login | Logout Routes
// Route::get('login', [loginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/authenticate', [loginController::class, 'authenticate'])->name('authenticate');
Route::get('/face', [FaceController::class,'face'])->name('face.sign');
// Routes for admin auth
Route::middleware(['auth', 'userRole:admin'])->prefix('dashboard-admin')->group(function () {
    Route::get('/', [dashboardAdminController::class, 'index'])->name('admin');
    Route::get('/server', [dashboardAdminController::class, 'server'])->name('server.side');
    Route::get('/pelanggaran/{id}', [dashboardAdminController::class, 'pelanggaranData'])->name('pelanggaran.tampil');
    Route::resource('data-ta-semester', YearsemesterController::class); //model data T/A & Semester
    Route::resource('competences', competenceController::class); //model data Jurusan
    Route::resource('subjects', subjectController::class); //model data Mapel
    Route::resource('classroom', classroomController::class); //model data Kelas
    Route::resource('students', studentController::class); //model data siswa
    Route::resource('teachers', teacherController::class); //model data guru
    Route::resource('violations', violationController::class); //model data pelanggaran
    Route::resource('sekolah', SekolahController::class); //model data pelanggaran
    Route::get('/get-data-sekolah', [dashboardAdminController::class, 'showKepsek']);
    Route::get('/is-wali-kelas/{teacher_id}', [dashboardAdminController::class, 'IsWaliKelas']);
    Route::get('/get-cek-siswa/{classroom}', [dashboardAdminController::class, 'cekSiswa']);
    Route::get('/getClassroom/{competence_id}', [dashboardAdminController::class, 'getKelas']);
});
//route untuk guru dan admin fungsi
Route::middleware(['auth', 'userRole:guru,admin,guruPiket'])->group(function() {
    Route::resource('pelanggaran', PelanggaranController::class); //model circle pelanggaran
    Route::get('/getClassroom/{compID}', [studentController::class, 'getClassroom']);
});
// Routes for teacher auth
Route::middleware(['auth', 'userRole:guru'])->prefix('dashboard-guru')->group(function () {
    Route::get('/', [dashboardGuruController::class, 'index'])->name('teacher');
    Route::get('/siswa-pelanggaran', [dashboardGuruController::class, 'siswaPelanggaran'])->name('siswa.pelanggaran');
    Route::get('/siswa-biodata', [dashboardGuruController::class, 'infoSiswa'])->name('siswa.biodata');
    Route::delete('/delete-data-siswa/{student}', [dashboardGuruController::class, 'deleteSiswa'])->name('delete.siswa');
    Route::put('/update-data-siswa/{student}', [dashboardGuruController::class, 'updateSiswa'])->name('update.siswa');
    Route::get('/tampil-data-siswa/{student}', [dashboardGuruController::class, 'tampilEditDataSiswa'])->name('tampilData.siswa');
    Route::get('/informasi-siswa/{student}', [dashboardGuruController::class, 'profileSiswa'])->name('profileSiswa');
    Route::post('/tambah-siswa', [dashboardGuruController::class, 'tambahSiswa'])->name('tambah.siswa');
    Route::put('/update-profile/{teacher}', [dashboardGuruController::class, 'updateDataPribadi'])->name('updateDataPribadi');
    Route::get('/info-panggilan/{panggilan_id}', [dashboardGuruController::class, 'infoPanggilan'])->name('infoPanggilan');
    Route::resource('panggilan-ortu-wali', PanggilanOrtuController::class);
    // Route::get('/siswa-pelanggaran-server', [dashboardGuruController::class, 'serverPelanggaran'])->name('server.pelanggaran');
});
// Routes for logout
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [logoutController::class, 'logout'])->name('logout');
    Route::get('/profile', [profileController::class, 'index'])->name('profile');
    Route::get('/data-get-kelas-profile/{competence_id}', [dashboardSiswaController::class, 'getKelasProfile']);
    Route::post('/change-password', [changePasswordController::class, 'changePassword'])->name('change.password');
});
//route untuk guru piket
Route::middleware(['auth', 'userRole:guruPiket'])->prefix('dashboard-guru-piket')->group(function () {
    Route::get('/', [dashboardGuruPiketController::class, 'index'])->name('guru.piket');
    Route::get('/siswa-pelanggaran', [dashboardGuruPiketController::class, 'siswaPelanggaran'])->name('siswa.pelanggaran.piket');
    Route::get('/get-classroom/{id}', [dashboardGuruPiketController::class,'getClassroom'])->name('get.classroom');
    Route::get('/get-siswa/{id}', [dashboardGuruPiketController::class, 'getSiswa'])->name('get.siswa');
});
//route untuk siswa
Route::middleware(['auth', 'userRole:siswa'])->prefix('dashboard-siswa')->group(function () {
   Route::get('/', [dashboardSiswaController::class, 'index'])->name('siswa');
   Route::put('/edit-profile-siswa/{student}', [dashboardSiswaController::class, 'editProfileSiswa']);
   Route::get('/data-pelanggaran', [dashboardSiswaController::class, 'pelanggaran'])->name('pelanggaran');
   Route::get('/data-panggilan', [dashboardSiswaController::class, 'dataPanggilan'])->name('dataPanggilan');
   Route::get('/data-panggilan-profile/{panggilan_id}', [dashboardSiswaController::class, 'profilePanggilan'])->name('profilePanggilan');
});
//route untuk kreator
Route::middleware(['auth', 'userRole:kreator'])->prefix('dashboard-kreator')->group(function () {
   Route::get('/', [dashboardKreatorController::class, 'index'])->name('kreator');
   Route::resource('kreator', KreatorController::class);
});
//route landing page
Route::get('/', [dashboardLandingPageController::class, 'index'])->name('landing.page.index');
Route::get('/visi-misi', [dashboardLandingPageController::class, 'visiMisi'])->name('visi.misi.index');
Route::get('/tata-tertib-siswa', [dashboardLandingPageController::class, 'tataTertib'])->name('tata.tertib.index');
Route::get('/poin-pelanggaran', [dashboardLandingPageController::class, 'poinPelanggaran'])->name('poin.pelanggaran.index');
//route untuk berita
Route::get('/berita-siwan', [dashboardLandingPageController::class, 'berita'])->name('berita.index');
Route::get('/berita/{title}', [dashboardLandingPageController::class, 'singlePost'])->name('berita.single');
//route register
Route::get('/register-siwan', [RegisterController::class,'index'])->name('register.index');
Route::post('/register-siwan-tambah', [RegisterController::class,'register'])->name('register.store');
route::get('/get-class-register/{competence_id}', [RegisterController::class,'getKelas']);

Route::get('/foo', function () {
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
    // Artisan::call('storage:link');
});

// klo gak bisa /foo ganti dengan "ln -s /home/pplp9949/addon_domain/testweb.pplg-smkn4tpi.com/storage/app/public/images /home/pplp9949/public_html/testweb.pplg-smkn4tpi.com/storage"

Route::get('/{any}', function () {
    return view('errors.404'); // Menampilkan halaman 404 yang sudah Anda persiapkan di direktori views/errors/404.blade.php
})->where('any', '.*');

