<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;

Route::group(['controller' => StripePaymentController::class], function () {
    Route::get('/stripe', 'index')->name('stripe.index');
    Route::post('/make-payment', 'make_payment')->name('stripe.make.payment');
});