<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index(Request $request) {
        return view('artists.index');
    }
}
