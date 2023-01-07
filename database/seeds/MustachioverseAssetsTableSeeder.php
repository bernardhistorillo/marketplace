<?php

use App\MustachioverseAsset;
use Illuminate\Database\Seeder;

class MustachioverseAssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 128; $i++) {
            MustachioBackground::create([
                'name' => 'Mustachio Background #' . $i,
                'image' => 'https://ipfs.io/ipfs/QmabkWG6G6QQ8A3i2JTgqp29ZyqoL34XCXoVR3qXDzvusU',
                'attributes' => [
                    [
                        "trait_type" => "Asset Type",
                        "value" => "Digital Art"
                    ], [
                        "trait_type" => "Country",
                        "value" => "Philippines"
                    ], [
                        "trait_type" => "Year",
                        "value" => "2021"
                    ]
                ],
            ]);
        }
    }
}
