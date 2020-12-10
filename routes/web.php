<?php

use Illuminate\Support\Facades\Route;

Route::view('', 'welcome')->name('init');
Route::view('faqs', 'faqs')->name('fasqs');
Route::view('acercaDeNosotros', 'nosotros')->name('nosotros');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['permiso:listar'])
    ->name('home');

Auth::routes();

Route::resource('blog', App\Http\Controllers\BlogController::class)->only(['index', 'show', 'destroy']);
Route::resource('finder', App\Http\Controllers\AdoptionFinderController::class)->only(['index', 'show', 'store', 'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');
/*Route::get('test', function () {
    $to_name = "Registrado a Adoption finder";
    $to_email = "xandyx2014@gmail.com";
\Illuminate\Support\Facades\Mail::send("email.welcome",[] ,function ($message) use ($to_name, $to_email) {
    $message->to($to_email)
        ->subject($to_name);
    $message->from("xandyx2014@gmail.com", "Bienvenido a Adoption finder");
});
    return "hola mundo";
});*/
// verification
Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function ($request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::post('resendEmailVerification', [\App\Http\Controllers\UserController::class, 'resendEmailVerification'])->name('resendEmailVerification');


