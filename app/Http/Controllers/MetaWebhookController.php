<?php

namespace App\Http\Controllers;

use App\Models\WhatsappMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MetaWebhookController extends Controller
{
    public function verify(Request $request)
    {
        $verifyToken = 'your_custom_verify_token';
        $mode = $request->get('hub_mode');
        $token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');
        if ($mode && $token === $verifyToken) {
            return response($challenge, 200);
        }
        return response('Verification failed', 403);
    }
    public function handle(Request $request)
    {
        try {
            $data = $request->all();
            // $data = [
            //     'entry' => [
            //         [
            //             'changes' => [
            //                 [
            //                     'value' => [
            //                         'messages' => [
            //                             [
            //                                 'from' => '923001234567', // Static sender's WhatsApp number
            //                                 'id' => 'ABCD1234', // Static message ID
            //                                 'timestamp' => now()->timestamp, // Current timestamp
            //                                 'text' => [
            //                                     'body' => 'This is a test message!' // Static message text
            //                                 ],
            //                                 'type' => 'text'
            //                             ]
            //                         ]
            //                     ]
            //                 ]
            //             ]
            //         ]
            //     ]
            // ];
            // Log incoming data for debugging
            Log::info('Meta Webhook Received:', $data);

            // Check if messages exist in the payload
            if (isset($data['entry'][0]['changes'][0]['value']['messages'])) {
                foreach ($data['entry'] as $entry) {
                    foreach ($entry['changes'] as $change) {
                        $messages = $change['value']['messages'] ?? [];
                        foreach ($messages as $message) {
                            $from = $message['from'];
                            $text = $message['text']['body'] ?? null;
                            $msgId = $message['id'];

                            // Save message to the database
                            WhatsappMessage::create([
                                'message_id' => $msgId,
                                'message' => $text,
                                'from' => $from,
                                'whole_message' => json_encode($message)
                            ]);

                            // Log the received message
                            Log::info("Received message from $from: $text");
                        }
                    }
                }
                // Return success response
                return response()->json(['status' => 'received'], 200);
            }

            // If no messages are found, return an error response
            return response()->json(['error' => 'No messages found in the payload'], 400);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error in Meta Webhook:', ['error' => $e->getMessage()]);

            // Return error response
            return response()->json(['error' => 'An error occurred', 'details' => $e->getMessage()], 500);
        }
    }
}
