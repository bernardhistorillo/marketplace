<?php

namespace App\Http\Controllers;

use App\Collection;
use App\LaunchpadToken;
use App\Favorite;
use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CollectionController extends Controller
{
    public function index(Request $request) {
        $collection = $request->collection;

        $collection = Collection::where('url', $collection)
            ->first();

        if(!$collection) {
            abort(404);
        }

        $filters = ($request->filters) ? json_decode($request->filters, true) : [];
        $tokens = $collection->tokens($filters);
        $properties = $collection->properties();
        $rarities = $collection->rarities();

//        $owners = [];
//
//        foreach($tokens as $token) {
//            $owners[] = $token['to'];
//        }
//
//        return $owners;

        return view('collection.index', compact('collection', 'tokens', 'properties', 'filters', 'rarities'));
    }

    public function getTokens(Request $request, $collection) {
        $collection = Collection::where('url', $collection)
            ->first();

        $filters = json_decode($request->filters, true);
        $tokens = $collection->tokens($filters);

        return view('collection.tokenCards', compact('collection', 'tokens'));
    }

    public function updateViewOption(Request $request) {
        if($request->view == 'large-grid' || $request->view == 'small-grid') {
            $request->session()->put('collection_view', $request->view);
        }

        return $request->session()->get('collection_view');
    }

    public function getCollections(Request $request) {
        $collections = Collection::all();

        return response()->json([
            'collections' => $collections
        ]);
    }

    public function getLaunchpadCollections(Request $request) {
        $collections = Collection::where('is_launchpad_collection', 1)
            ->get();

        return response()->json([
            'collections' => $collections
        ]);
    }

    public function getLaunchpadCollectionItems($collection_id) {
        $launchpad_tokens = LaunchpadToken::where('collection_id', $collection_id)
            ->get();

        return response()->json([
            'launchpad_tokens' => $launchpad_tokens
        ]);
    }

    public function updateCollection(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'address' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        $collection = Collection::where('id', $request->id)
            ->where('owner', 'LIKE', $request->address)
            ->first();

        if($collection) {
            $collection->name = $request->name;
            $collection->description = $request->description;
            $collection->url = $request->url;
            $collection->properties = $request->properties;

            $logo = null;
            if($request->file('logo')) {
                $logo = $request->file('logo');
                $name = 'logo.' . $logo->getClientOriginalExtension();
                $logo = config('app.url') . '/storage/' . $request->file('logo')->storeAs('collections/' . $collection->id, $name, 'public');
            }
            if($logo) {
                $collection->logo = $logo;
            }

            $banner = null;
            if($request->file('banner')) {
                $banner = $request->file('banner');
                $name = 'banner.' . $banner->getClientOriginalExtension();
                $banner = config('app.url') . '/storage/' . $request->file('banner')->storeAs('collections/' . $collection->id, $name, 'public');
            }
            if($banner) {
                $collection->banner = $banner;
            }

            $collection->update();
        }

        return response()->json([
            'collection' => $collection
        ]);
    }

    public function updateCollectionItem(Request $request) {
        $request->validate([
            'collection_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->id == 0) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
            ]);
        } else {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
            ]);
        }

        $collection = Collection::where('id', $request->collection_id)
            ->where('owner', 'LIKE', $request->address)
            ->first();

        if(!$collection) {
            abort(404);
        }

        if($request->id == 0) {
            $latest_launchpad_token = LaunchpadToken::where('collection_id', $collection->id)
                ->orderBy('token_id', 'desc')
                ->first();

            $token_id = 1;
            if($latest_launchpad_token) {
                $token_id = $latest_launchpad_token['token_id'] + 1;
            }

            $launchpad_token = new LaunchpadToken();
            $launchpad_token->collection_id = $collection->id;
            $launchpad_token->token_id = $token_id;
            $launchpad_token->name = $request->name;
            $launchpad_token->description = $request->description;

            if($request->file('image')) {
                $image = $request->file('image');
                $name = 'image.' . $image->getClientOriginalExtension();
                $image = config('app.url') . '/storage/' . $request->file('image')->storeAs('collections/' . $collection->id . '/' . $token_id, $name, 'public');
                $launchpad_token->image = $image;
            }

            $launchpad_token->attributes = "[]";
            if($collection->properties != "") {
                $trait_types = json_decode($collection->properties, true);
                $property_values = json_decode($request->properties, true);
                $properties = [];

                foreach($trait_types as $i => $trait_type) {
                    array_push($properties, [
                        'trait_type' => $trait_type,
                        'value' => $property_values[$i],
                    ]);
                }

                $launchpad_token->attributes = json_encode($properties);
            }

            $launchpad_token->save();
        }

        return response()->json([
            'launchpad_token' => $launchpad_token
        ]);
    }
}
