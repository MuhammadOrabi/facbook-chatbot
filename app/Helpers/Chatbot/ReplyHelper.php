<?php

namespace App\Helpers\Chatbot;

class ReplyHelper
{
    public static function text($sender, $message)
    {
        return [ 
            'text' => $message
        ];
    }

    public static function buttons()
    {
        // 
    }

    public static function image()
    {
        // 
    }

    public static function geniricMessage()
    {
        // 
    }
}