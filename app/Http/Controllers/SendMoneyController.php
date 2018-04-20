<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class SendMoneyController extends Controller
{
    public function send(Request $request)
    {
        // validate the request
        $validate = $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric'
        ]);

        //  check if user is logged in and then handle request
        if (Auth::check()) {
            $sender = Auth::user();

            $recipient = User::where('email', $request->email)->first();

            $sender->update([
                'balance' => $sender->balance - $request->amount
            ]);

            $recipient->update([
                'balance' => $recipient->balance + $request->amount
            ]);
        
            return redirect()->action('HomeController@index')->with(['status' => "$$request->amount sent to $recipient->name ($recipient->email)"]);
        }

        // throw error here
        return back()->with(['error' => 'Sorry money could not be sent']);
    }
}
