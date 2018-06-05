<?php

namespace App\Helpers\Chatbot;

class ScenariosHelper
{
    public static function handle($message)
    {
        if (strpos($message, 'hello') !== false) {
            return ReplyHelper::text('hey, how are you doing?');
        }
    }
}