<?php

use App\Http\Controllers\Api\EmojiController;
use Illuminate\Support\Facades\Route;

Route::get('emojis', [EmojiController::class, 'index']);
