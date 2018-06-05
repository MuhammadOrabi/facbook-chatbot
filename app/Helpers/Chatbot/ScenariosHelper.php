<?php

namespace App\Helpers\Chatbot;

class ScenariosHelper
{
    public static function handle($message)
    {
        if (strpos($message, 'hello') !== false) {
            // return ReplyHelper::text('Hey, wanna look for new deals?');
            $departments = collect([
                ['id' => 1, 'title' => 'travel'],
                ['id' => 2, 'title' => 'banking'],
                ['id' => 3, 'title' => 'insurance'],
                ['id' => 4, 'title' => 'education'],
            ]);

            return ReplyHelper::handle('generic', 'Choose one of our departments', $departments);
        } else if (strpos($message, 'web') !== false) {
            return ReplyHelper::generic('This is a title', []);
        } else {
            return ReplyHelper::quickReply();
        }
    }
}