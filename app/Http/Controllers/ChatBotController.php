<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function get(Request $request)
    {
        $VERIFY_TOKEN = env('CHATPOT_VERIFY_TOKEN');
        $mode = $request->query('hub_mode');
        $token = $request->query('hub_verify_token');
        $challenge = $request->query('hub_challenge');
        abort_if(! $mode && $token, 404);
        if ($mode === 'subscribe' && $token === $VERIFY_TOKEN) {
            return response($challenge, 200);
        } else {
            return response($mode, 403);            
        }
    }

    public function posts(Request $request)
    {
        $messaging_events = $request->all()['entry'][0]['messaging'];
        foreach ($messaging_events as $event) {
            $sender = $event['sender']['id'];
            if ($event['message'] && $event['message']['text']) {
                $data = ['text' => $event['message']['text']];
                
                $client = new \GuzzleHttp\Client();
                $url = 'https://graph.facebook.com/v2.6/me/messages?=';

                $headers = [
                    'Content-type' => 'application/json; charset=utf-8',
                    'Accept' => 'application/json',
                ];
                $messageData = [
                        'recipient' => ['id' => $sender],
                        'message' => $data
                ];
                $client->request('POST', $url, [
                    'query' => ['access_token' => env('CHATPOT_PAGE_ACCESS_TOKEN')],
                    'headers' => $headers,
                    'json' => $messageData
                ]);
            }
        }
        return response(200);
    }

    public function post(Request $request)
    {
        $messaging_events = $request->all()['entry'][0]['messaging'];
        foreach ($messaging_events as $event) {
            $sender = $event['sender']['id'];
            if ($event['message'] && $event['message']['text']) {
                \App\Helpers\Chatbot\ChatBotHelper::handle($event);
            }
        }
        return response(200);        
    }

}
