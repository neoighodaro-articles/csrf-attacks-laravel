<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric'
        ]);

        $sender = auth()->user();
        $recipient = User::where('email', $data['email'])->first();

        $sender->charge($data['amount']);
        $recipient->grant($data['amount']);

        return redirect()->action('HomeController@index')
            ->withStatus("${$data['amount']} sent to {$recipient->name}");
    }
}
