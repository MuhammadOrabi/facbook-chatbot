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
        $messaging_events = $request->all()['entry'][0]['messaging'];
        foreach ($messaging_events as $event) {
            $sender = $event['sender']['id'];
            if ($event['message'] && $event['message']['text']) {
                $data = ['text' => $event['message']['text']];
                file_put_contents('postLog.txt', json_encode($event));
                
                // $client = new \GuzzleHttp\Client();
                $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . env('CHATPOT_PAGE_ACCESS_TOKEN');
                $headers = [
                    'Content-type' => 'application/json; charset=utf-8',
                    'Accept' => 'application/json',
                ];
                $messageData = [
                        'messaging_type' => 'response',
                        'recipient' => ['id' => $sender],
                        'message' => $data
                ];
                // $promise = $client->postAsync($url, $headers, $body);
                // $promise->then(function (ResponseInterface $res) {
                //     file_put_contents('postLog.txt', $res->getStatusCode());                    
                // },
                // function (RequestException $e) {
                //     file_put_contents('postLog.txt', $e->getMessage());                                        
                // });
            }
        }
        return response(200);
    }
}
