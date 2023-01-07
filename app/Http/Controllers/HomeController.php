<?php

namespace App\Http\Controllers;

use App\AmacRegistrants;
use App\Collection;
use App\EmailSignup;
use App\LaunchpadToken;
use App\Mail\AmacTicket;
use App\MustachioRascal;
use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index(Request $request) {
        $collections = Collection::where('is_curated', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('home.index', compact('collections'));
    }

    public function mustachioModel(Request $request, $tokenId) {
        $mustachios = Token::select('token_id', 'name', 'thumbnail')
        ->where(function($where) {
            $where->where('collection_id', 4);
            $where->where('token_id', '<=', 100);
        })
        ->orWhere(function($where) {
            $where->where('collection_id', 11);
            $where->where('token_id', '>=', 101);
        })
        ->get();

        $bgColor = $request->bgColor;
        $hasShadow = $request->s;
        $download = $request->download;
        $file = $request->file;
        $tokenIds = $request->tokenIds;
        $tokenIdsIn = $request->tokenIdsIn;
        $zoom = $request->zoom;
        $animation = $request->animation;
        $async = $request->async;
        $update = $request->update;
        $hideSettings = $request->hideSettings;

        $rascalsMetadata = MustachioRascal::select('image', 'attributes')
            ->get();

        return view('layouts.model', compact('tokenId', 'bgColor', 'hasShadow', 'download', 'file', 'tokenIds', 'tokenIdsIn', 'zoom', 'animation', 'async', 'update', 'mustachios', 'rascalsMetadata', 'hideSettings'));
    }

    public function emailSignup(Request $request) {
        $request->validate([
            'email' => 'required'
        ]);

        $emailSignup = EmailSignup::where('email', 'LIKE', $request->email)
            ->where('type', 'LIKE', $request->type)
            ->first();

        if(!$emailSignup) {
            $emailSignup = new EmailSignup();
            $emailSignup->email = $request->email;
            $emailSignup->type = $request->type;
            $emailSignup->data = $request->data;
            $emailSignup->save();
        } else {
            $emailSignup->data = $request->data;
            $emailSignup->update();
        }

        return response()->json([
            'emailSignup' => $emailSignup
        ]);
    }

    public function amacRegistrantUpdateStatus(Request $request) {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        $amacRegistrant = AmacRegistrants::find($request->id);

        if($amacRegistrant['is_validated'] == 0) {
            if($request->status == -1) {
                $amacRegistrant->is_validated = -1;
            } else {
                $amacRegistrant->is_validated = $amacRegistrant['id'] - 1;
            }
            $amacRegistrant->update();
            Mail::to($amacRegistrant['email'])->send(new AmacTicket($amacRegistrant));
            Mail::to('bernardhistorillo1@gmail.com')->send(new AmacTicket($amacRegistrant));
        }

        return response()->json([]);
    }

    public function getEmailSignups(Request $request) {
        $emailSignupTypes = ['bbc', 'amacph'];
        $emailSignups = [];

        foreach($emailSignupTypes as $emailSignupType) {
            $emailSignups[$emailSignupType] = EmailSignup::where('type', $emailSignupType)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('layouts.emailSignups', compact('emailSignupTypes', 'emailSignups'));
    }

    public function amacRegister(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'shirt' => 'required|in:XS,S,M,L,XL',
            'organization' => 'required',
            'payment' => 'required|file|between:0,10000',
        ]);

        $amacRegistrant = AmacRegistrants::where('email', $request->email)
            ->first();

        if(!$amacRegistrant) {
            $amacRegistrant = new AmacRegistrants();
        }

        $amacRegistrant->firstname = $request->firstname;
        $amacRegistrant->lastname = $request->lastname;
        $amacRegistrant->contact_number = $request->contact_number;
        $amacRegistrant->email = $request->email;
        $amacRegistrant->address = $request->address;
        $amacRegistrant->shirt = $request->shirt;
        $amacRegistrant->organization = $request->organization;

        $file = $request->file('payment');
        $name = $file->hashName();
        $extension = $file->extension();
        $img = Image::make($file);
        $img->stream($extension, 100);
        Storage::put('public/amac-payments/' . $name, $img);

        $amacRegistrant->payment =  config('app.url') . '/storage/amac-payments/' . $name;
        $amacRegistrant->save();

        return response()->json([
            'status' => true
        ]);
    }

    public function amacVerifiedRegistrantsCount(Request $request) {
        $count = AmacRegistrants::where('is_validated', '!=', 0)
            ->count();

        return response()->json([
            'count' => $count
        ]);
    }

    public function getAmacRegistrants(Request $request) {
        $amacRegistrants = AmacRegistrants::orderBy('id', 'desc')
            ->get();

        return view('layouts.amacRegistrants', compact('amacRegistrants'));
    }
}
