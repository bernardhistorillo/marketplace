<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HelperController extends Controller
{
    public static function resizeImage($name, $url, $extension, $dimension) {
        $name = $name . '.' . $extension;
        $path = 'thumbnails/' . $extension . '/' . $dimension . '/' . $name;

        $img = Image::make($url);

        $img->resize(($img->width() >= $img->height()) ? $dimension : null, ($img->width() < $img->height()) ? $dimension : null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->stream($extension, 100);
        Storage::put('public/' . $path, $img);

        return config('app.url') . '/storage/' . $path;
    }
}
