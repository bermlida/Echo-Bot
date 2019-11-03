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
        $channel_access_token = 'GoB7zOHb0++xHZY00n6XjnAENU+y6uueDCS8spvDvT03NgC2uj0acP7+YH1hulAykg72aXbGh7Kth+gDnplgoMmqhufHscXowUeRdmu8TkUDcRQmY5raQYhcaVy74UcYyCQNDgsXR+jYxEJkFL9cGQdB04t89/1O/w1cDnyilFU=';
        print 12345; return 12345;
        $httpClient = new CurlHTTPClient($channel_access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

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
