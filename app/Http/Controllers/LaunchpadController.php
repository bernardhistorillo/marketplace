<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaunchpadController extends Controller
{
    public function index(Request $request) {
        return view('launchpad.index');
    }
}
