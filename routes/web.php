<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

            // return ReplyHelper::text('Hey, wanna look for new deals?');
            $data = collect([
                [
                    'id' => 1, 'title' => 'banking', 
                    'sections' => collect([
                        ['id' => 1, 'title' => 'credit-card'],
                        ['id' => 2, 'title' => 'personal-loan'],
                        ['id' => 3, 'title' => 'car-loan'],
                        ['id' => 4, 'title' => 'mortage-finance'],
                        ['id' => 5, 'title' => 'account'],
                        ['id' => 6, 'title' => 'deposite'],
                    ])
                ],
                [
                    'id' => 2, 'title' => 'insurance', 
                    'sections' => collect([['id' => 1, 'title' => 'car-insurance']])
                ],
                [
                    'id' => 3, 'title' => 'travel',
                    'sections' => collect([
                        ['id' => 1, 'title' => 'domestic'],
                        ['id' => 2, 'title' => 'international'],
                        ['id' => 3, 'title' => 'honeymoon-domestic'],
                        ['id' => 4, 'title' => 'hajj'],
                        ['id' => 5, 'title' => 'umrah'],
                        ['id' => 6, 'title' => 'visa'],
                    ])
                ],
                [
                    'id' => 4, 'title' => 'education', 
                    'sections' => collect([
                        ['id' => 1, 'title' => 'development'],
                        ['id' => 2, 'title' => 'language'],
                        ['id' => 3, 'title' => 'kids-language'],
                        ['id' => 4, 'title' => 'kids-development'],
                        ['id' => 5, 'title' => 'study-abroad'],
                    ])
                ],
            ]);

            dd(\App\Helpers\Chatbot\ReplyHelper::handle('generic', $data),\App\Helpers\Chatbot\ReplyHelper::handle('generics', $data));
        
    return view('welcome');
});

Route::get('/privacy_policy', function () {
    return view('privacy_policy');
});
