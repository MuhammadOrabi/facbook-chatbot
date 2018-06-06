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
            $elements[] = [
                "title" => $item['title'], 
                "item_url" => 'https://www.qarenhom.com/en/' . $item['title'], 
                "image_url" => "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",         
                "subtitle" => "Choose carefully",
                "buttons" => [
                    [
                        "type" => "web_url", 
                        "url" => "https://www.qarenhom.com/en/" . $item['title'], 
                        "title" => "View Website"
                    ], 
                    [
                        "type" => "postback", 
                        "title" => $item['title'], 
                        "payload" => $item['title']
                    ]
                ]
            ];
        }
        return $elements; 
    }

    public static function generic($data)
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

    public static function listElements($data)
    {
        $elements = [];
        foreach ($data->toArray() as $item) {
            $elements[] = [
            "title"=>"Migrate symfony from cpanel",
            "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
            "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
            "subtitle"=>"We've got the right hat for everyone.",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://cloudways.com",
                "title"=>"View Website"
              ],
            ]
          ];
        }
        return $elements;
    }

    public static function list($data)
    {
        $elements = self::listElements($data);
        return [
            "attachment" => [
                "type" => "template", 
                "payload" => [
                    "template_type" => "list",
                     "elements"=>$elements
                ]
            ]
        ];
    }
}