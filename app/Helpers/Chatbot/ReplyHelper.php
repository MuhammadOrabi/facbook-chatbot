<?php

namespace App\Helpers\Chatbot;

class ReplyHelper
{

    public static function handle($type, $data)
    {
        return self::$type($data);
    }

    public static function text($message)
    {
        return [ 
            'text' => $message
        ];
    }

    public static function genericElements($data)
    {
        $elements = [];
        foreach ($data->toArray() as $item) {
            $elm = [
                "title" => $item['title'], 
                "item_url" => 'https://www.qarenhom.com/en/' . $item['title'], 
                "image_url" => "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",         
            ];
            foreach ($item['sections']->toArray() as $section) {
                $elm['buttons'][] = [
                    "type" => "web_url", 
                    "url" => 'https://www.qarenhom.com/en/' . $section['title'] . '/' . $section['title'], 
                    "title" => $section['title']
                ];
            }
            $elements[] = $elm;
        }
        return $elements; 
    }

    public static function generics($data)
    {
        $elements = self::genericElements($data);
          return [
            "attachment" => [
                "type" => "template", 
                "payload" => [
                    "template_type" => "generic",
                    "elements" => $elements
                ]
            ]
        ];
    }

    public static function generic($data)
    {
        return [
            "attachment" => [
                "type" => "template", 
                "payload" => [
                    "template_type" => "generic", 
                    "elements" => [
                        [
                            "title" => "Migrate your symfony application", 
                            "item_url" => "https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/", 
                            "image_url" => "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg", 
                            "subtitle" => "Migrate your symfony application from Cpanel to Cloud.", 
                            "buttons" => [
                                [
                                    "type" => "web_url", 
                                    "url" => "www.cloudways.com", 
                                    "title" => "View Website"
                                ], 
                                [
                                    "type" => "postback", 
                                    "title" => "Start Chatting", 
                                    "payload" => "get started"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}