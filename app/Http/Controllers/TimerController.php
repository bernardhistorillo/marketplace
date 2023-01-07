<?php

namespace App\Http\Controllers;

use App\ChenInkToken;
use App\MarketItemFavorite;
use App\TokenTransfer;
use Carbon\Carbon;

class TimerController extends Controller
{
    public function get_remaining_time($date) {
        return Carbon::parse($date)->getTimestamp() - Carbon::now()->getTimestamp();
    }

    public function get_remaining_time_from_timestamp($timestamp) {
        return $timestamp - Carbon::now()->getTimestamp();
    }
}
