<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

# API Data user telegram
Route::post('telegram/users', [\App\Http\Controllers\APITelegramUsersController::class, 'telegramUsers'])->name('api/telegram/users')->methods(['POST']);

# API Data group telegram
Route::post('telegram/groups', [\App\Http\Controllers\APITelegramGroupsController::class, 'telegramGroups'])->name('api/telegram/groups')->methods(['POST']);

# API Data administrator group telegram
Route::post('telegram/groups/administrators', [\App\Http\Controllers\APITelegramGroupAdministratorsController::class, 'telegramGroupAdministrators'])->name('api/telegram/groups/administrators')->methods(['POST']);

# API data language bot telegram
Route::post('telegram/language/bot', [\App\Http\Controllers\APITelegramLanguageBotController::class, 'telegramLanguageBot'])->name('api/telegram/language/bot')->methods(['POST']);

# API data language group telegram
Route::post('telegram/language/group', [\App\Http\Controllers\APITelegramLanguageGroupsController::class, 'telegramLanguageGroup'])->name('api/telegram/language/group')->methods(['POST']);

# API data telegram message
Route::post('telegram/messages', [\App\Http\Controllers\APITelegramMessagesController::class, 'telegramMessages'])->name('api/telegram/messages')->methods(['POST']);