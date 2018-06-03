<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function get(Request $request)
    {
        $VERIFY_TOKEN = env('CHATPOT_VERIFY_TOKEN');
        $mode = $request->query('hub_mode');
        $token = $request->query('hub_verify_token');
        $challenge = $request->query('hub_challenge');
        abort_if(! $mode && $token, 404);
        if ($mode === 'subscribe' && $token === $VERIFY_TOKEN) {
            return response($challenge, 200);
        } else {
            return response($mode, 403);            
        }
    }

    public function post(Request $request)
    {
        // 
    }
}
