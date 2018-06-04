<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

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
                $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . env('CHATPOT_PAGE_ACCESS_TOKEN');
                $messageData = [
                    'messaging_type' => 'Text',
                    'recipient' => ['id' => $sender],
                    'message' => $data
                ];
                $builder = new Process(array(
                    'curl', '-X', 'POST', '-H', 'Content-Type: application/json', '-d', $messageData, $url
                ));
            }
        }
        return response(200);
    }
}
