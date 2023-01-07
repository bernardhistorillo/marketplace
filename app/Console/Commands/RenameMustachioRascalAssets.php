<?php

namespace App\Console\Commands;

use App\MustachioRascal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;
use Hashids\Hashids;


class RenameMustachioRascalAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:rename_mustachio_rascal_assets';

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

        $mustachioRascals = MustachioRascal::query()
//            ->whereNotIn('id', [
//                47,127,381,415,737,1088,1407,1431,1653,2127,2247,2362,2688,2963,3578,3621,3713,3764,4336,4514,4549,4653,4821,4844,4946,4949,5330,5391,5555,5598,5651,5729,5929,6035,6732,7256,7285,7478,7644,7667,7705,8067,8401,8659,8854,8871,8873,8932,9069,9837,
//                222,347,621,956,992,1151,1474,1746,2182,2250,2299,2432,2597,2598,2912,3138,3231,3596,3696,3803,4081,4106,4278,4667,4917,5089,5250,5442,5845,5964,6145,6531,6616,6946,6968,7085,7307,7592,7838,7890,8166,8417,8428,8462,8526,8622,8927,8951,9299,9536,
//                60,104,657,764,1034,1190,1422,1499,2053,2132,2174,2198,2468,2602,2970,3054,3362,3566,3688,3707,4029,4041,4078,4087,4318,4342,4379,4393,4410,4868,5155,5242,6104,6430,6683,7248,7545,7829,7852,8120,8608,8648,8663,8705,8834,8924,8986,9132,9389,9642,
//                68,201,451,602,910,1425,1558,2005,2892,3032,3163,3253,3787,3868,3872,4250,4406,4847,4930,5080,5228,5240,5542,5743,6019,6063,6270,6337,6421,6579,6727,6886,6974,7124,7587,7596,7597,7807,7910,8018,8131,8351,8667,8835,8860,8898,8907,9474,9762,9948,
//                323,427,686,871,949,968,1015,1063,1145,1243,1633,1778,1829,1965,2451,2572,2803,2821,2895,3232,3598,3640,3703,4122,4367,4501,4620,4893,4904,5128,5362,5435,5528,5699,5948,6435,6802,6849,7059,7084,7394,7615,7627,8013,8480,9039,9082,9235,9589,9962,
//                84,179,225,482,649,787,863,1844,2018,2184,2277,2446,2519,2604,2712,2849,3064,3450,3457,3607,3801,3845,4331,4467,4519,4710,4757,5312,5677,5837,6170,6460,6504,7008,7573,7594,7808,7938,7972,8075,8478,8613,8766,8858,9281,9328,9686,9901,9912,9954,
//                2153,2263,2320,4787,4978,6305,7233,9458,9528,9967,
//                533,1991,3861,4175,4360,5687,6235,7560,8546,8982,
//                1204,1488,1556,3477,5985,6371,7834,8646,9219,9227,
//                231,623,1970,2208,4611,4895,5689,6710,7788,8380,
//                893,1069,1997,3123,3665,4496,4803,5703,8003,9698,
//                149,247,260,272,565,1053,1155,1182,1390,1568,1743,1792,1831,2108,2239,2773,2956,3043,3267,3293,3437,3694,3771,4222,4996,5141,5206,5276,5502,5657,6289,6372,6391,6427,6634,6729,6934,7141,7361,7612,8219,8276,8387,8714,8943,9127,9213,9452,9609,9640,
//                859,965,980,1338,1852,2122,2493,2992,3338,3407,4231,4466,4571,5198,8442,8534,9350,9469,9480,9590,
//            ])
//            ->where('id', '>=', 520)
//            ->where('id', '<', 1000)
            // PHWeb3Fest
//            ->whereIn('id', [142,203,305,499,1126,1205,1268,1702,1796,1835,2016,2396,2414,2478,2522,2555,3021,3079,3136,3181,3936,4436,4658,5031,5090,5156,5515,5846,5847,6020,6101,6152,6269,6813,6985,7484,7621,8295,8326,8392,8452,8597,9042,9169,9176,9301,9511,9608,9622,9717])
            // DivinaLaw
//            ->whereIn('id', [160,184,280,354,811,1257,1464,1873,1897,2015,2090,2241,2281,2287,2603,2606,2661,2734,2755,2815,3289,3354,4135,4258,4643,4721,5246,5352,5456,5460,5462,5611,5825,5888,6007,6129,6302,6549,6707,7095,7448,7802,8094,8155,8676,9104,9173,9232,9872,9971])
            // Meatspace
            ->whereIn('id', [26,366,1013,1370,1726,1867,2021,2126,2258,2345,2724,2752,2853,2986,3052,3326,3438,3487,3502,3544,3664,3961,4337,4965,4973,5058,5065,5078,5632,5760,6013,6053,6093,6240,6259,6260,6323,6423,6462,6480,6735,7023,7215,7222,7954,8554,8841,8897,9209,9557])
            ->get();

        $notExists = [];
        $tokenIdsPlus10k = [];
        foreach($mustachioRascals as $mustachioRascal) {
//            $uuid = Str::uuid();
            $uuid = explode('https://ownly.io/nft/mustachiorascals/gif/', $mustachioRascal->image);
            $uuid = explode('.gif', $uuid[1]);
//            $out->writeln(($mustachioRascal['id'] - 1) . ': ' . $uuid[0]);

//            $mustachioRascal->image = 'https://ownly.io/nft/mustachiorascals/gif/' . $uuid . '.gif';
//            $mustachioRascal->update();

            if(file_exists(storage_path() . "/app/rascalFBX/" . ($mustachioRascal['id'] - 1) . ".fbx")) {
                $out->writeln(($mustachioRascal['id'] - 1) . ' ' . $uuid[0]);
                Storage::copy("rascalFBX/" . ($mustachioRascal['id'] - 1) . ".fbx", "rascalFBXRenamed/" . $uuid[0] . ".fbx");
            } else {
                $notExists[] = $mustachioRascal['id'];
                $out->writeln('Not Exists: ' . ($mustachioRascal['id'] - 1));
            }

//            if(file_exists(storage_path() . "/app/rascalMP4/" . ($mustachioRascal['id'] + 9999) . ".mp4")) {
//                $out->writeln(($mustachioRascal['id'] - 1) . ' ' . $uuid[0]);
//                Storage::copy("rascalMP4/" . ($mustachioRascal['id'] + 9999) . ".mp4", "rascalMP4Renamed/" . $uuid[0] . ".mp4");
//            } else {
//                $notExists[] = $mustachioRascal['id'];
//                $out->writeln('Not Exists: ' . ($mustachioRascal['id'] + 9999));
//            }

//            if(file_exists(storage_path() . "/app/rascalGIF/" . ($mustachioRascal['id'] + 9999) . ".gif")) {
//                $out->writeln(($mustachioRascal['id'] - 1) . ' ' . $uuid[0]);
//                Storage::copy("rascalGIF/" . ($mustachioRascal['id'] + 9999) . ".gif", "rascalGIFRenamed/" . $uuid[0] . ".gif");
//            } else {
//                $notExists[] = $mustachioRascal['id'];
//                $out->writeln('Not Exists: ' . ($mustachioRascal['id'] + 9999));
//            }

            $tokenIdsPlus10k[] = $mustachioRascal['id'] + 9999;
        }

        $out->writeln(json_encode($notExists));
        $out->writeln(json_encode($tokenIdsPlus10k));
    }
}
