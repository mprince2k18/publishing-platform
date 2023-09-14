<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembershipController;

Route::group(['controller' => MembershipController::class], function () {
    Route::get('/memberships', 'index')->name('memberships.index');
    Route::get('/membership/{type}', 'membership_type')->name('membership.type');
    Route::post('/membership/register', 'register')->name('member.register');
});