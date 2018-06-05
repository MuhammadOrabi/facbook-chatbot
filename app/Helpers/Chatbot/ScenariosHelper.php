<?php

namespace App\Helpers\Chatbot;

class ScenariosHelper
{
    public static function handle($message)
    {
        if (strpos($message, 'hello') !== false) {
            return ReplyHelper::text('Hey, How are you doing?');
        } else if (strpos($message, 'web') !== false) {
            return ReplyHelper::buttons();
        } else {
            return ReplyHelper::quickReply();
        }
    }
}