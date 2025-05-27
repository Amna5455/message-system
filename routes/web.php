<?php

use App\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', [MessagesController::class,'index'])->name('messages');
    Route::get('create', [MessagesController::class,'create'])->name('messages.create');
    Route::post('/', [MessagesController::class,'store'])->name('messages.store');
    Route::get('{id}', [MessagesController::class,'show'])->name('messages.show');
    Route::put('{id}', [MessagesController::class,'update'])->name('messages.update');
    Route::get('destroy/{id}', [MessagesController::class,'destroy'])->name('messages.destroy');
});

Route::post('/webhook/whatsapp', function (Request $request) {
    // $data = $request->all();
    $data = [
        'entry' => [
            [
                'changes' => [
                    [
                        'value' => [
                            'messages' => [
                                [
                                    'from' => '923001234567', // Static sender's WhatsApp number
                                    'id' => 'ABCD1234', // Static message ID
                                    'timestamp' => now()->timestamp, // Current timestamp
                                    'text' => [
                                        'body' => 'This is a test message!' // Static message text
                                    ],
                                    'type' => 'text'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
                                ];
    // Check if the message is valid
    if (isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {
        $message = $data['entry'][0]['changes'][0]['value']['messages'][0];

        // Extract message details
        $from = $message['from']; // Sender's WhatsApp number
        $text = $message['text']['body'] ?? ''; // Message text
        dd($from,$text);
        // Log or process the message
        Log::info("Message received from $from: $text");

        // Respond to WhatsApp (optional)
        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'no_message']);
});

Route::group(['prefix' => 'whatsapTemplate'], function() {

    Route::get('/', [App\Http\Controllers\WhatsappTemplateController::class, 'index'])->name('whatsappTemplate');
    Route::get('create', [App\Http\Controllers\WhatsappTemplateController::class, 'create'])->name('whatsappTemplate.create');
    Route::post('/store', [App\Http\Controllers\WhatsappTemplateController::class, 'store'])->name('whatsappTemplate.store');
    Route::get('{id}', [App\Http\Controllers\WhatsappTemplateController::class, 'show'])->name('whatsappTemplate.show');
    Route::put('{id}', [App\Http\Controllers\WhatsappTemplateController::class, 'update'])->name('whatsappTemplate.update');
    Route::get('destroy/{id}', [App\Http\Controllers\WhatsappTemplateController::class, 'destroy'])->name('whatsappTemplate.destroy');
});
