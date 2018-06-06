<?php

namespace App\Helpers\Chatbot;

class ScenariosHelper
{
    public static function handle($message)
    {
        $data = collect([
                    collect([
                        'id' => 1, 'title' => 'banking', 
                        'sections' => collect([
                            ['id' => 1, 'title' => 'credit-card'],
                            ['id' => 2, 'title' => 'personal-loan'],
                            ['id' => 3, 'title' => 'car-loan'],
                            ['id' => 4, 'title' => 'mortage-finance'],
                            ['id' => 5, 'title' => 'account'],
                            ['id' => 6, 'title' => 'deposite'],
                        ])
                    ]),
                    collect([
                        'id' => 2, 'title' => 'insurance', 
                        'sections' => collect([['id' => 1, 'title' => 'car-insurance']])
                    ]),
                    collect([
                        'id' => 3, 'title' => 'travel',
                        'sections' => collect([
                            ['id' => 1, 'title' => 'domestic'],
                            ['id' => 2, 'title' => 'international'],
                            ['id' => 3, 'title' => 'honeymoon-domestic'],
                            ['id' => 4, 'title' => 'hajj'],
                            ['id' => 5, 'title' => 'umrah'],
                            ['id' => 6, 'title' => 'visa'],
                        ])
                    ]),
                    collect([
                        'id' => 4, 'title' => 'education', 
                        'sections' => collect([
                            ['id' => 1, 'title' => 'development'],
                            ['id' => 2, 'title' => 'language'],
                            ['id' => 3, 'title' => 'kids-language'],
                            ['id' => 4, 'title' => 'kids-development'],
                            ['id' => 5, 'title' => 'study-abroad'],
                        ])
                    ]),
                ]);
        if (strpos($message, 'list') !== false) {
            return ReplyHelper::handle('list', $data);
        } else if (strpos($message, 'text') !== false) {
            return ReplyHelper::handle('text', 'This is a title');
        } else if (strpos($message, 'generic') !== false) {
            return ReplyHelper::handle('generic', $data);
        } else {
            // return ReplyHelper::quickReply();
        }
    }
}