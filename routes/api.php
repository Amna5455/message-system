<?php

use App\Http\Controllers\MetaWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
Route::get('/webhook', [MetaWebhookController::class, 'verify']);
Route::post('/webhook', [MetaWebhookController::class, 'handle']);
