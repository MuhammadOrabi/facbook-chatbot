<?php

namespace App\Helpers\Chatbot;

class ChatBotHelper
{
    public static function handle($event)
    {
        $reply = ScenariosHelper::handle($event['message']['text']);
        self::sendRequest($event['sender']['id'], $reply);
    }

    public static function sendRequest($sender, $reply)
    {
        
        $client = new \GuzzleHttp\Client();
        $url = 'https://graph.facebook.com/v2.6/me/messages?=';

        $headers = [
            'Content-type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json',
        ];
        try {
            $client->request('POST', $url, [
                'query' => ['access_token' => env('CHATPOT_PAGE_ACCESS_TOKEN')],
                'headers' => $headers,
                'json' => [
                    'recipient' => ['id' => $sender],                
                    'message' => $reply
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            echo $e->getResponse();
        }
    }
}