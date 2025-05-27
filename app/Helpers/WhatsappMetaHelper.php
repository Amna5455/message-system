<?php


namespace App\Helpers;

use App\Models\WhatsappMessage;
use Illuminate\Support\Facades\Http;

class WhatsappMetaHelper
{

    public static function WhatsappApis($data)
    {
        // dd('Whatsapp Meta APIs are being called');
        $accessToken = env('FACEBOOK_ACCESS_TOKEN');
        $wabaId = env('WABA_ID');
        $apiVersion = env('GRAPH_API_VERSION', 'v19.0'); // fallback agar env me nahi mila

        $url = "https://graph.facebook.com/{$apiVersion}/{$wabaId}/message_templates";
        if($data->broadcast_type == 'text'){

            self::WhatsappHeaderTxt($accessToken,$url,$data);
        }elseif($data->broadcast_type == 'image'){

            self::WhatsappHeaderImg($accessToken,$url,$data);
        }
        elseif($data->broadcast_type == 'location' ){

            self::WhatsappHeaderLoc($accessToken,$url,$data);
        }
        elseif($data->broadcast_type == 'document' ){

            self::WhatsappHeaderDoc($accessToken,$url,$data);
        }
        self::WhatsappGetTemById($apiVersion);
        self::WhatsappGetTemByName($apiVersion,$wabaId);
        self::WhatsappGetAllTemp($apiVersion,$wabaId);

    }

    public static function WhatsappGetTemById($apiVersion){

        $response = Http::get("https://graph.facebook.com/{$apiVersion}/<TEMPLATE_ID>");

        self::saveResponse($response->json(),'Get Template By Id Api');
    }
    public static function WhatsappGetTemByName($apiVersio,$wabaId){

        $response = Http::get("https://graph.facebook.com/{$apiVersio}/{$wabaId}/message_templates?name=<TEMPLATE_NAME>");
        self::saveResponse($response->json(),'Get Template By Name Api');
    }
    public static function WhatsappGetAllTemp($apiVersio,$wabaId){

        // dd($apiVersio,$wabaId);
        $response = Http::get("https://graph.facebook.com/{$apiVersio}/{$wabaId}/message_templates");
        self::saveResponse($response->json(),'Get All Templates Api');
        // dd( $response->json());
    }
    public static function WhatsappHeaderTxt($accessToken,$url,$data){

        $response = Http::withToken($accessToken)->post($url, [
            "name" => $data->template_name,
            "language" => $data->language,
            "category" => "MARKETING",
            "components" => [
                [
                    "type" => "HEADER",
                    "format" => 'TEXT',
                    "text" => $data->broadcast_description,
                    "example" => [
                        "header_text" => ["Summer Sale"]
                    ]
                ],
                [
                    "type" => "BODY",
                    "text" => $data->body_text,
                    "example" => [
                        "body_text" => [["the end of August", "25OFF", "25%"]]
                    ]
                ],
                [
                    "type" => "FOOTER",
                    "text" => $data->footer_text,
                ],
                [
                    "type" => "BUTTONS",
                    "buttons" => [
                        [
                            "type" => "QUICK_REPLY",
                            "text" => $data->quick_reply_text
                        ],
                        [
                            "type" => "QUICK_REPLY",
                            "text" => "Unsubscribe from All"
                        ]
                    ]
                ]
            ]
        ]);

        // dd($response->json());
        self::saveResponse($response->json(),'Header Text Api');

    }
    public static function WhatsappHeaderImg($accessToken,$url,$data){

        $response = Http::withToken($accessToken)->post($url, [
            "name" => $data->template_name,
            "language" => $data->language,
            "category" => "MARKETING",
            "components" => [
                [
                    "type" => "HEADER",
                    "format" => "IMAGE",
                    "example" => [
                        "header_handle" => [
                            "4::aW..." // your media ID
                        ]
                    ]
                ],
                [
                    "type" => "BODY",
                    "text" => $data->body_text,
                    "example" => [
                        "body_text" => [
                            [
                                "Mark",
                                "Tuscan Getaway package",
                                "800"
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "FOOTER",
                    "text" => $data->footer_text
                ],
                [
                    "type" => "BUTTONS",
                    "buttons" => [
                        [
                            "type" => "PHONE_NUMBER",
                            "text" => $data->phone_number_description,
                            "phone_number" => $data->phone_number
                        ],
                        [
                            "type" => "URL",
                            "text" => $data->website_description,
                            "url" => $data->website_url,
                            "example" => [
                                "summer2023"
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        // Response handle karein
        self::saveResponse($response->json(),'Header Image Api');
    }
    public static function WhatsappHeaderLoc($accessToken,$url,$data){

        $response = Http::withToken($accessToken)->post($url, [
            "name" => $data->template_name,
            "language" => $data->language,
            "category" => "UTILITY",
            "components" => [
                [
                    "type" => "HEADER",
                    "format" => "LOCATION"
                ],
                [
                    "type" => "BODY",
                    "text" => $data->body_text,
                    "example" => [
                        "body_text" => [
                            [
                                "Mark",
                                "566701"
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "FOOTER",
                    "text" => $data->footer_text
                ],
                [
                    "type" => "BUTTONS",
                    "buttons" => [
                        [
                            "type" => "QUICK_REPLY",
                            "text" => $data->qquick_reply_text
                        ]
                    ]
                ]
            ]
        ]);

        self::saveResponse($response->json(),'Header Location Api');
    }
    public static function WhatsappHeaderDoc($accessToken,$url,$data){

        $response = Http::withToken($accessToken)->post($url, [

            "name" => $data->template_name,
            "language" => $data->language,
            "category" => "UTILITY",
            "components" => [
                [
                    "type" => "HEADER",
                    "format" => "DOCUMENT",
                    "example" => [
                        "header_handle" => [
                            "4::YXBwbGljYXRpb24vcGRm:ARZVv4zuogJMxmAdS3_6T4o_K4ll2806avA7rWpikisTzYPsXXUeKk0REjS-hIM1rYrizHD7rQXj951TKgUFblgd_BDWVROCwRkg9Vhjj-cHNQ:e:1681237341:634974688087057:100089620928913:ARa1ZDhwbLZM3EENeeg"
                        ]
                    ]
                ],
                [
                    "type" => "BODY",
                    "text" => $data->body_text,
                    "example" => [
                        "body_text" => [
                            [
                                "Mark", "860198-230332"
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "BUTTONS",
                    "buttons" => [
                        [
                            "type" => "PHONE_NUMBER",
                            "text" => $data->phone_number_description,
                            "phone_number" => $data->phone_number
                        ],
                        [
                            "type" => "URL",
                            "text" => $data->website_description,
                            "url" => $data->website_url
                        ]
                    ]
                ]
            ]
        ]);

        self::saveResponse($response->json(),'Header Document Api');
        // Response handle karein
        // if ($response->successful()) {
        //     return response()->json([
        //         'message' => 'Template created successfully!',
        //         'data' => $response->json()
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => 'Failed to create template.',
        //         'error' => $response->json()
        //     ], $response->status());
        // }
    }

    public static function saveResponse($res,$message){

        WhatsappMessage::create([

            'whole_message' => json_encode($res),
            'message' => $message
        ]);
    }

    public static function sendWhatsappMessage($userPhoneNumber,$whatsappMessage,$wabaId){

        $whatsappResponse = Http::withHeaders([
            'Authorization' => 'Bearer EAAIcWBetlOsBO4owsaxHfqzGDf1EmpWVXpyOsgOoKVUqVKDJasVXrENi4a9DJGz6XItYy5ioHl00X8d3hMyVZBRYtBnggdWz6d6bqbOO7yR82JpCbhG9ShXhF8ClhkdMNxhUeRQlWcOw3lFpFGVZBWcYhOAkkxNBRC5ZA6gKE8pkE3weA2JJXQUNliqjdc4DcsGxQiXSqRc4Dz13UCAqDmhiAq6',
            'Content-Type' => 'application/json',
        ])->post("https://graph.facebook.com/v22.0/{$wabaId}/messages", [

            'messaging_product' => 'whatsapp',
            'to' => $userPhoneNumber,  // WhatsApp number (with country code)
            'type' => 'text',
            'text' => [
                'body' => $whatsappMessage
            ]
        ]);

        return $whatsappResponse;

    }

}
