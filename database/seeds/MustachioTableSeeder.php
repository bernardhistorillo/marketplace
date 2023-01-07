<?php

use App\Mustachio;
use Illuminate\Database\Seeder;

class MustachioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 100; $i++) {
            Mustachio::create([
                'name' => 'Mustachio #' . $i,
                'description' => 'They are described to have round heads, mesmerizing eyes casted with spells that can transport them to another scene in a blink, and their key determining factor - each with their own unique staches. As to why they have this feature? We have yet to find out. 100 Mustachios will be introduced.  You, the collector will be transported into the MustachioVerse as a Mustachio via RANDOM selection.',
                'image' => 'https://ipfs.io/ipfs/QmabkWG6G6QQ8A3i2JTgqp29ZyqoL34XCXoVR3qXDzvusU',
                'attributes' => [
                    [
                        "trait_type" => "Year",
                        "value" => "2021"
                    ], [
                        "trait_type" => "Country",
                        "value" => "Philippines"
                    ], [
                        "trait_type" => "Asset Type",
                        "value" => "Digital Art"
                    ]
                ],
                'exists' => 0,
            ]);
        }
    }
}
