<?php

use Illuminate\Support\Facades\Route;
use Varsha\Socialite\Http\Controllers\FacebookController;
use Varsha\Socialite\Http\Controllers\GitHubController;
use Varsha\Socialite\Http\Controllers\GoogleController;
use Varsha\Socialite\Http\Controllers\LinkedinController;
use Varsha\Socialite\Http\Controllers\TwitterController;

Route::group(['prefix' => 'auth', 'middleware' => 'web'], function () {
    Route::get('login', [GoogleController::class, 'showLoginForm'])->name('login');

    //end points related to google login
    Route::get('google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);

    //end points related to github login
    Route::get('github', [GitHubController::class, 'redirectToGitHub'])->name('auth.github');
    Route::get('github/callback', [GitHubController::class, 'handleGitHubCallback']);

    //end points related to github login
    Route::get('facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

    //end points related to linkedin login
    Route::get('linkedin', [LinkedinController::class, 'redirectToLinkedin'])->name('auth.linkedin');
    Route::get('linkedin/callback', [LinkedinController::class, 'handleLinkedinCallback']);

    //end points related to linkedin login
    Route::get('twitter', [TwitterController::class, 'redirectToTwitter'])->name('auth.twitter');
    Route::get('twitter/callback', [TwitterController::class, 'handleTwitterCallback']);
});
