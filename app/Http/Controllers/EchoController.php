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
        $input = request()->all();

        $reply_token = array_get($input, 'events.0.replyToken');

        $httpClient = new CurlHTTPClient('AJizgzjmcMNqqJUQOCqmT9WojBwfu9DM0LyjLaqWq9Ak5f8GRROdbDRk9R9ikfVskg72aXbGh7Kth+gDnplgoMmqhufHscXowUeRdmu8TkV/cmd5HJGQu4ppov/G4AUYPdXQ/20Vut+Z4nDRYmhafgdB04t89/1O/w1cDnyilFU=');
        $bot = new LINE\LINEBot($httpClient, ['channelSecret' => 'cf202899151c09cc2f844f5326841b69']);
        
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
        $response = $bot->replyMessage($reply_token, $textMessageBuilder);

        if ($response->isSucceeded()) {
            echo 'Succeeded!';
            return 200;
        }

        // Failed
        echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }
}
