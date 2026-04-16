<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::livewire('/csv', 'pages::csv.upload');
Route::livewire('/message', 'pages::user.message');
