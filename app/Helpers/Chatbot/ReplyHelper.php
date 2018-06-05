<?php

namespace App\Helpers\Chatbot;

class ReplyHelper
{
    public static function text($message)
    {
        return [ 
            'text' => $message
        ];
    }

    public static function buttons($title, $buttons)
    {
        return [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'button',
                    'text' => $title,
                    'buttons' => $buttons
                ]
            ]
        ];
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