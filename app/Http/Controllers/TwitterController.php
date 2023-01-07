<?php
namespace App\Http\Controllers;
use App\BadgeClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function loginwithTwitter()
    {
        return Socialite::driver('twitter-oauth-2')->redirect();
    }

    public function cbTwitter()
    {
        try {
            $user = Socialite::driver('twitter-oauth-2')->user();

            $badgeClaim = BadgeClaim::where('twitter_id', 'LIKE', $user->user['id'])
                ->first();

            if(!$badgeClaim) {
                $badgeClaim = new BadgeClaim();
                $badgeClaim->twitter_id = $user->user['id'];
                $badgeClaim->twitter_details = json_encode([
                    'image' => $user->user['profile_image_url'],
                    'username' => $user->user['username'],
                    'name' => $user->user['name']
                ]);
                $badgeClaim->save();
            }

            session(['twitter_auth' => $badgeClaim]);

            return redirect()->route('elixir.index', ['#claim']);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
