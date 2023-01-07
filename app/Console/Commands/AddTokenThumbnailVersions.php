<?php

namespace App\Console\Commands;

use App\Collection;
use App\Http\Controllers\HelperController;
use App\Mustachio;
use App\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddTokenThumbnailVersions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:add_token_thumbnail_versions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $out = new ConsoleOutput();

        $tokens = Token::all();

        foreach($tokens as $token) {
            json_decode($token['thumbnail']);

            if(json_last_error() !== JSON_ERROR_NONE) {
                $out->writeln('Token ID: ' . $token['id']);

                if(!$token['thumbnail']) {
                    $token->thumbnail = $token->image;
                }

                $token['thumbnail'] = str_replace(' ','%20', $token['thumbnail']);
                $thumbnail['original'] = $token['thumbnail'];

                if(!str_contains($token['thumbnail'], '.mp4')) {
                    if(str_contains($token['thumbnail'], '.gif')) {
                        $thumbnail['jpg512'] = HelperController::resizeImage($token['id'], $token['thumbnail'], 'jpg', '512');
                        $thumbnail['gif'] = $token['thumbnail'];
                    } else {
                        $thumbnail['jpg512'] = HelperController::resizeImage($token['id'], $token['thumbnail'], 'jpg', '512');
                        $thumbnail['webp512'] = HelperController::resizeImage($token['id'], $token['thumbnail'], 'webp', '512');
                        $thumbnail['webp256'] = HelperController::resizeImage($token['id'], $token['thumbnail'], 'webp', '256');
                    }
                }

                $token->thumbnail = json_encode($thumbnail);
                $token->update();
            }
        }

        return 0;
    }
}
