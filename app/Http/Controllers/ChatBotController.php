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

    public function post(Request $request)
    {
        session($request->all());
        // $messaging_events = $request->all()['entry'][0]['messaging'];
        // foreach ($messaging_events as $event) {
        //     $sender = $event['sender']['id'];
        //     if ($event['message'] && $event['message']['text']) {
        //         $data = ['text' => $event['message']['text']];
        //         $client = new \GuzzleHttp\Client();
        //         $res = $client->request('POST', 'https://graph.facebook.com/v2.6/me/messages', [
        //             'query' => ['access_token' => env('CHATPOT_PAGE_ACCESS_TOKEN')],
        //             'json' => [
        //                 'recipient' => ['id' => $sender],
        //                 'message' => $data
        //             ]
        //         ]);
        //     }
        // }
        return response(200);
    }
}
