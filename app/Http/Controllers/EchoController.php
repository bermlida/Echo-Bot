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
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $channel_id = '1653378500';
        $channel_secret = 'cf202899151c09cc2f844f5326841b69';

        $httpClient = new CurlHTTPClient();
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

        $response = $bot->createChannelAccessToken($channel_id);
        $channel_access_token = $response->getJSONDecodedBody();
        $access_token = array_get($channel_access_token, 'access_token');

        $input = $request->all();
        $reply_token = array_get($input, 'events.0.replyToken');        
        $textMessageBuilder = new TextMessageBuilder('hello');
        $response = $bot->replyMessage($reply_token, $textMessageBuilder);
        
        return 'success';
        // if ($response->isSucceeded()) {
        //     echo 'Succeeded!';
        //     return 200;
        // }

        // // Failed
        // echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }
}
