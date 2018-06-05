<?php

namespace App\Helpers\Chatbot;

class ScenariosHelper
{
    public static function handle($message)
    {
        if (strpos($message, 'hello') !== false) {
            return ReplyHelper::text('Hey, How are you doing?');
        } else if (strpos($message, 'webs') !== false) {
            return ReplyHelper::buttons('Surfe the web', [
                ['type' => 'web_url', 'url' => 'https://google.com', 'title' => 'Google'],
                ['type' => 'web_url', 'url' => 'https://facebook.com', 'title' => 'Facebook'],
                ['type' => 'web_url', 'url' => 'https://youtube.com', 'title' => 'YouTube'],
                ['type' => 'web_url', 'url' => 'https://twitter.com', 'title' => 'Twitter'],
            ]);
        }
    }
}