<?php

namespace App\Http\Controllers;

use App\MustachioSubscriber;
use Illuminate\Http\Request;

class MustachioSubscriberController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'email_address' => 'required|email'
        ]);

        $mustachio_subscriber = MustachioSubscriber::where('email_address', $request->email_address)
            ->first();

        if(!$mustachio_subscriber) {
            $mustachio_subscriber = new MustachioSubscriber;
            $mustachio_subscriber->email_address = $request->email_address;
            $mustachio_subscriber->save();
        }

        return response()->json([
            'data' => $mustachio_subscriber
        ]);
    }
}
