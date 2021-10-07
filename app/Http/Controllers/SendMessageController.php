<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;
use App\Message;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendMessageJob;
use App\Events\MessageEvent;

class SendMessageController extends Controller
{
    public function sendMessage(Request $request){

        $data = Message::create([
                    'message' =>  $request->message,
                    'user_id' => Auth::user()->id
                ]);

        SendMessageJob::dispatch($data)->delay(now()->addSeconds(10));

        // MessageEvent::dispatch($data, $request->message);

        return redirect()->back();
    }
}
