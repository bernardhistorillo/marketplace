<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\Collection;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\MustachioRascalsController;
use App\Mustachio;
use App\MustachioRascal;
use App\Token;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;

class StoreMustachioRascalsMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:store_mustachio_rascals_metadata';

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

        // storing from json metadata generated in hashlips
//        $rascals = json_decode(file_get_contents(storage_path() . "/app/rascals.json"), true);
//        MustachioRascal::truncate();
//        $mustachioRascals = [];
//        foreach($rascals as $i => $rascal) {
//            $out->writeln($i);
//
//            $mustachioRascals[] = [
//                'name' => 'Mustachio Rascal #' . $i,
//                'description' => 'Another set of Mustachio adventurers are joining the Pathfinders (2D and 3D Genesis Mustachios) and Marauders (Second Generation Mustachios) as they explore the Metaverse! Here comes the Mustachio Rascals, the next generation of our Mustachios. With a maximum supply of 10,000 Generated 3D NFTs, the Mustachio Rascals are the third generation of Mustachios. Of course, you may explore and play Mustachio Quest with your 3D Mustachio Rascal.',
//                'image' => 'https://mustachio.quest/rascals/prereveal/breathing-idle.mp4',
//                'attributes' => json_encode($rascal['attributes']),
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ];
//        }
//
//        MustachioRascal::insert($mustachioRascals);

        // Start: Step 1: assigning of custom shirts to randomly picked tokens
        $customShirts = (new MustachioRascalsController())->customShirts();

        $shirtCombinations = [
            'Shirt Plus Shorts',
            'Shirt Plus Pants',
            'Shirt Plus Ripped Jeans',
        ];

//        $shirtCombinations = [
//            'Turtleneck Plus Shorts',
//            'Turtleneck Plus Pants',
//            'Turtleneck Plus Ripped Jeans',
//        ];

        foreach($customShirts as $customShirt) {
            $tokenCount = MustachioRascal::where('attributes', 'LIKE', '%' . $customShirt['name'] . '%')
                ->count();

            for($i = $tokenCount; $i < $customShirt['count']; $i++) {
                $out->writeln($customShirt['name'] . ': ' . ($i + 1) . ' of ' . $customShirt['count']);

                do {
                    $tokenId = rand(1,10000);
                    $mustachioRascal = MustachioRascal::find($tokenId);
                    $attributes = json_decode($mustachioRascal['attributes'], true);
                } while(str_contains($attributes[8]['value'], 'Shirt') || str_contains($attributes[8]['value'], 'Turtleneck'));

                $attributes[3]['value'] = $shirtCombinations[rand(0, 2)];
                $attributes[8]['value'] = $customShirt['name'];

                $mustachioRascal->attributes = json_encode($attributes);
                $mustachioRascal->update();
            }
        }
//
//        foreach($customShirts as $customShirt) {
//            $tokenCount = MustachioRascal::where('attributes', 'LIKE', '%' . $customShirt['name'] . '%')
//                ->count();
//
//            $out->writeln($customShirt['name'] . ': ' . $tokenCount);
//
//            // Copy updatedRascals.json content to _updatedMetadata.json of mustachio-rascals-generator repository
//            // Copy token Ids to tokenIdsToBeUpdated variable
//            // Run generate FBX command
//            $tokenIds = MustachioRascal::where('attributes', 'LIKE', '%' . $customShirt['name'] . '%')
//                ->select('id')
//                ->pluck('id');
//
//            $out->writeln(json_encode($tokenIds));
//        }
//
//        // writing the updated metadata to json file
//        $mustachioRascals = MustachioRascal::select('name', 'description', 'image', 'attributes')
//            ->get();
//
//        foreach($mustachioRascals as $mustachioRascal) {
//            $mustachioRascal->attributes = json_decode($mustachioRascal->attributes, true);
//        }
//
//        Storage::put('updatedRascals.json', $mustachioRascals);
        // End: Step 1: assigning of custom shirts to randomly picked tokens

        // storing from the updated rascals json file
//        MustachioRascal::truncate();
//
//        $rascals = json_decode(file_get_contents(storage_path() . "/app/updatedRascals.json"), true);
//        $mustachioRascals = [];
//        foreach($rascals as $i => $rascal) {
//            $out->writeln($i);
//
//            $mustachioRascals[] = [
//                'name' => $rascal['name'],
//                'description' => $rascal['description'],
//                'image' => $rascal['image'],
//                'attributes' => json_encode($rascal['attributes']),
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ];
//        }
//
//        MustachioRascal::insert($mustachioRascals);
//        MustachioRascal::query()->update([
//            'exists' => null
//        ]);

        // Start: Step 2: Storing the updated rascals to JSON file. Should be run in local
//        $mustachioRascals = MustachioRascal::query()
//            // PHWeb3Fest
////            ->whereIn('id', [142,203,305,499,1126,1205,1268,1702,1796,1835,2016,2396,2414,2478,2522,2555,3021,3079,3136,3181,3936,4436,4658,5031,5090,5156,5515,5846,5847,6020,6101,6152,6269,6813,6985,7484,7621,8295,8326,8392,8452,8597,9042,9169,9176,9301,9511,9608,9622,9717])
//            // Divina Law
////            ->orWhereIn('id', [160,184,280,354,811,1257,1464,1873,1897,2015,2090,2241,2281,2287,2603,2606,2661,2734,2755,2815,3289,3354,4135,4258,4643,4721,5246,5352,5456,5460,5462,5611,5825,5888,6007,6129,6302,6549,6707,7095,7448,7802,8094,8155,8676,9104,9173,9232,9872,9971])
//            // Meatspace
//            ->orWhereIn('id', [26,366,1013,1370,1726,1867,2021,2126,2258,2345,2724,2752,2853,2986,3052,3326,3438,3487,3502,3544,3664,3961,4337,4965,4973,5058,5065,5078,5632,5760,6013,6053,6093,6240,6259,6260,6323,6423,6462,6480,6735,7023,7215,7222,7954,8554,8841,8897,9209,9557])
//            ->get();
//
//        $updatedMustachioRascals = [];
//        foreach($mustachioRascals as $mustachioRascal) {
//            $uuid = explode('https://ownly.io/nft/mustachiorascals/gif/', $mustachioRascal->image);
//            $uuid = explode('.gif', $uuid[1]);
//
//            $updatedMustachioRascals[] = [
//                'uuid' => $uuid[0],
//                'attributes' => $mustachioRascal['attributes']
//            ];
//
//            $out->writeln($mustachioRascal['id']);
//        }
//        Storage::put('rascalsWithNewMetadata.json', json_encode($updatedMustachioRascals));
        // End: Step 2: Storing the updated rascals to JSON file. Should be run in local

        // Start: Step 3: Updating the database with new rascal metadata. Should be run in prod
//        $updatedMustachioRascals = json_decode(file_get_contents(storage_path() . "/app/rascalsWithNewMetadata.json"), true);
//        foreach($updatedMustachioRascals as $updatedMustachioRascal) {
//            $mustachioRascal = MustachioRascal::where('image', 'LIKE', '%' . $updatedMustachioRascal['uuid'] . '%')
//                ->first();
//
//            $mustachioRascal->attributes = $updatedMustachioRascal['attributes'];
//            $mustachioRascal->update();
//
//            $out->writeln($updatedMustachioRascal['uuid']);
//        }
        // End: Step 3: Updating the database with new rascal metadata. Should be run in prod
    }
}
