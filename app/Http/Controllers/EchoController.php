<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class EchoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * echo receive message.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $channel_id = config('services.line.channel_id');
        $channel_secret = config('services.line.channel_secret');
        $channel_access_token = config('services.line.channel_access_token');
        
        $httpClient = new CurlHTTPClient($channel_access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

        $input = $request->all();
        $reply_token = array_get($input, 'events.0.replyToken');
        $receive_message = array_get($input, 'events.0.message.text');

        $textMessageBuilder = new TextMessageBuilder('echo you say: ' . $receive_message);
        $response = $bot->replyMessage($reply_token, $textMessageBuilder);
        
        // Succeeded
        if ($response->isSucceeded()) {
            return 'Succeeded!';
        }

        // Failed
        return $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }
}
