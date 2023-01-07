<?php

namespace App\Http\Controllers;

use App\MustachioverseAsset;
use Illuminate\Http\Request;

class MustachioverseAssetsController extends Controller
{
    public function __construct(MustachioverseAsset $mustachio) {
        $this->mustachioAsset = $mustachio;
    }

    public function getMustachioverseAsset($id) {
        $mustachioAsset = $this->mustachioAsset->find($id);
        return $mustachioAsset;
    }
    public function getMustachioverseAssetWithGroup($id, $group) {
        $mustachioAsset = $this->mustachioAsset->where('id', $id)->where('group_id', $group)->get();
        return $mustachioAsset;
    }

    public function getMustachioverseAssets() {
        $mustachioAssets = $this->mustachioAsset->orderBy('group_id', 'asc')->orderBy('id', 'asc')->get();
        return $mustachioAssets;
    }

    public function getMustachioverseAssetsLimit($group, $page = 1, $page_count = 12) {
        $offset = (($page - 1) * $page_count);
        $mustachioAssets = $this->mustachioAsset->where('group_id', $group)->skip($offset)->limit($page_count)->get();
        return $mustachioAssets;
    }

    public function incrementSupplyMinted(Request $request) {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $mustachioAsset = $this->getMustachioverseAsset($request->id);
        $mustachioAsset->supply = (int)$mustachioAsset->supply + 1;
        $mustachioAsset->save();

        dd($mustachioAsset);

        return response()->json([
            'data' => $mustachioAsset
        ]);
    }
}
