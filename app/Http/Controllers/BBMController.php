<?php

namespace App\Http\Controllers;

use App\BBMSignup;
use App\QuestOneReward;
use App\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BBMController extends Controller
{
    public function signup(Request $request) {
        $request->validate([
            'email_address' => 'required'
        ]);

        $bbmSignup = BBMSignup::where('email', 'LIKE', $request->email_address)
            ->first();

        if(!$bbmSignup) {
            $bbmSignup = new BBMSignup();
        }

        $bbmSignup->name = 'N/A';
        $bbmSignup->email = $request->email_address;
        $bbmSignup->organization = 'N/A';
        $bbmSignup->reason = 'For the next Blockchain Meetup';
        $bbmSignup->save();

        return response()->json([
            'bbmSignup' => $bbmSignup
        ]);
    }
}
