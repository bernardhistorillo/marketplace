<?php

namespace App\Console\Commands;

use App\Http\Controllers\MustachioController;
use App\Mustachio;
use App\MustachioPathfinderMarauder;
use App\Token;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

class GenerateMustachioPathfinderMarauderMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:generate_mustachio_pathfinder_marauder_metadata';

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

//        For Pathfinders
//        $mustachios = Mustachio::orderBy('id')
//            ->get();
//
//        foreach($mustachios as $i => $mustachio) {
//            $out->writeln($mustachio['id'] . ' - ' . $mustachio['name']);
//
//            $mustachioPathfinderMarauder = MustachioPathfinderMarauder::find($mustachio['id']);
//
//            if(!$mustachioPathfinderMarauder) {
//                $mustachioPathfinderMarauder = new MustachioPathfinderMarauder();
//            }
//
//            $mustachioPathfinderMarauder->name = $mustachio['name'];
//            $mustachioPathfinderMarauder->description = $mustachio['description'];
//            $mustachioPathfinderMarauder->image = 'https://ownly.tk/nft/3dmustachios/' . $mustachio['id'] . '.jpg';
//            $mustachioPathfinderMarauder->attributes = $mustachio['attributes'];
//            $mustachioPathfinderMarauder->save();
//        }

        $names = [
            'Grave Keeper',
            'Gladiator',
            'Warrior',
            'Bird Watcher',
            'Football Player 26',
            'Dino Hoodie',
            'Chee',
            'Fishman Prince',
            'Guitar Man',
            'Farm Man Afro',
            'Mushroom Picker',
            'Jester',
            'Midas',
            'Hatcher',
            'Cheesy Hair',
            'Hip Hop',
            'Mech Suit',
            'Royal Gladiator',
            'Jedi',
            'Ice Hockey Player',
            'Paper Plane Maker',
            'Insurance Man',
            'Igorot',
            'Gardener',
            'Elvi',
            'Humanoid',
            'Forest Medic',
            'Forest Ranger',
            'Merchant',
            'Alien',
            'Gaijin',
            'Free Fall',
            'Nick',
            'Cave Man',
            'Judge',
            'Nest Head',
            'Marc',
            'Lunar Warrior',
            'Green Grass Cutter',
            'Jack and Brooky Fish',
            'Diver',
            'Forg',
            'Mountaineer',
            'Movies',
            'Geisha',
            'Piggy Baker',
            'Money Heist',
            'Dungeon Treasure Hunter',
            'Fisherfolk',
            'Uplander',
            'Media Man',
            'Gunner',
            'Mushroom Head',
            'Devirotchi',
            'Penggu',
            'Mr. Party Man',
            'Muncher',
            'Mr. Sheephead',
            'Fan Maker',
            'Elven Archer',
            'El Matador',
            'Robbert the Robber',
            'Parol',
            'Taylor',
            'Rick',
            'Paper Man Warrior',
            'On Guard',
            'Gorgon',
            'New Year Man',
            'Neos',
            'Red Skin',
            'Pinocchio',
            '3310',
            'Doctor',
            'Pot Maker',
            'Rockman',
            'Ratto',
            'Aeronaut',
            'Shaman',
            'Fisher',
            'Enchanter',
            'Alcalde',
            'Witch Doctor',
            'Punk',
            'Prisoner',
            'Postman',
            'Santa',
            'Pyro',
            'Honey Hunter',
            'Gift Wrap',
            'Pizza Man',
            'Robo Cap',
            'Magian',
            'Sharkboi',
            'Rein',
            'Yeti',
            'Box Head Swordsman',
            'Knuckles',
            'Ice Cream Vendor',
            'Ting',
            'Viking',
            'Mr. B',
            'Slow Man',
            'Snake Charmer',
            'Shoe Shine',
            'Space Elf',
            'Sledger',
            'Rap',
            'Squid Game Costume',
            'Hiker',
            'Adventurer',
            'WWE Champ',
            'Wild West',
            'Zombie Boi',
            'Vladislav',
            'Speedy',
            'Volts',
            'Aviator',
            'Botanist',
            'Soccer Player',
            'Clockwork',
            'Black Ninja',
            'Monkey King',
            'Swap Shaman',
            'Detonator Man',
            'Taho Vendor',
            'Pale Man',
            'Ticket Man',
            'Afro Skater',
            'Shipwright',
            'Night Hunter',
            'Saw',
            'Quack Head',
            'Turtle Prince',
            'Water Prince',
            'Crystal Hunter',
            'Buck',
            'Genie',
            'Stoner',
            'Viking',
            'Norsemen',
            'Treasure Hunter',
            'Van Helsing',
            'Wrong Turn',
            'Black & White Clown',
            'Manong',
            'Chef',
            'Vander Decken',
            'Grin',
            'Arduu',
            'Log',
            'Duck Cafe',
            'Pepe',
            'Deep Sea Diver',
            'Anubis',
            'Vortex',
            'Red Adventurer',
            'Blue Smith',
            'Cheese Maker',
            'Red Riding Hoodie',
            'Horus',
            'Cellist',
            'Invisible Man',
            'Black Bear Head',
            'Butcher',
            'Candy Rider',
            'Crow',
            'Nuttcracker',
            'Candy Hero',
            'Apple Picker',
            'Pick Pocket',
            'Death Bringer',
            'Squid Hunter',
            'Prison Number',
            'Barbarian',
            'Predator',
            'Wolf Guy',
            'Apple Seller',
            'Plumber',
            'Baker',
            'Bard',
            'Bonana Man',
            'Captain Crook',
            'Black Wizard',
            'Mr. Leaf',
            'Mr. Bones',
            'Mr. Bazooka',
            'Dark Shaman',
            'Arrow',
            'Appraiser',
            'Xergiok',
            'Cloudius',
            'Black Parade Drummer',
            'Caster',
            'Dragonfly Hunter',
            'Devil',
            'Line Man',
            'Yuzuhawa',
            'Bear Hunter',
            'Prospector'
        ];

        $jpgs = [144, 163, 165, 178, 184, 187, 195, 196, 211, 213, 214, 215, 227, 232, 234, 235, 239, 244, 245, 249, 252, 263, 268, 277, 278, 291, 295, 296, 298];

        $fileNames = [
            '44m169k9q7v8rlhq0geq',
            'vwaq54y1ocvo53srsbmd',
            'bnsidyec26ztj9u8qafg',
            'mmsl4ntu1hexv7sskgx9',
            'ub22xbgwu6k173prn2wy',
            'q04fuvqnzurb5g312rhg',
            'krxkoalfl9h03eot5oj7',
            '3apkuhtfh6t5xlkasmq2',
            'msy2ylfjjz7kf5pzelpm',
            'ff8yqke2zoqa3qtyauha',
            '9ba190nij5iagmfy6yyq',
            'zfg4ot3lsy84u81s580p',
            'mk716pl3h6nhkpg2zxxi',
            'l5djch9erql96qndrqt3',
            '3t7xd0maomk3dx5flum4',
            'i3pat7na8yk7qn07f8m2',
            'b6j86x052eacsnvcj5br',
            'l8gbe5l1aaw36y1ilck5',
            '6p0l8kebrcyayb6d8bd5',
            'c963y1zs2rg1dmomzvbm',
            'g5h0uoou123dp2o0enr0',
            'opuqbfy8fije81s4dgq8',
            's0bvyd6phde142506x7a',
            'pveit7nbg0uvuuetkpte',
            'ern9fafw8bjgf5d7wqdp',
            'ha06l0038zgf7bwzx1yf',
            'gwjflrpta1qorw3t7kli',
            'sl7dcy15y30f06kbas16',
            'szs4899aqd0b501wv8x7',
            'xuody0vc5ct33oagemlg',
            '4l7vftpulueda6aj0jmq',
            'hpi5pgcibd66phg5oqva',
            'cvqe9rswin0atnh8baqo',
            'wjg9g4cdm10taz6gxiki',
            '2av5emelha70ow31dyp0',
            '6bmz2vltsznhahm7pkq1',
            '16gxtwdfkp8dm5sv6xs0',
            '4csnaydyqn69vi4wsde8',
            'cp8qa0rvthnfdxswsxga',
            'izu325a5sw3hx1esemlt',
            '09o7p3n5vjgcxv4tl71f',
            '35k8bh8i0uhsu7mr1lr3',
            'dydd2rw76741mx2c562a',
            'mdfthjsqb2vjh1mjd6x5',
            'k767j7gb743eu1le457z',
            '22zba5gvujdhdqbdgj7d',
            '4yk7229cehgeqadcltrh',
            '1vebwolxi928srak28vl',
            'ekf17emked5dbarkgrhs',
            'qy14a8qcvg7eyz74ldn8',
            '65veqx8jsnswofh1zv5u',
            'galgwuag8kc68jy0fyob',
            'i9wc3e5qiamdla46d374',
            'd3avubngsjs370av0z62',
            'bxwlnqfgl8sbvwruveue',
            'vgotqvfwpic6gnyc3npx',
            '0b4fjt09jyvyp6k9zp9j',
            '7srfdau9i0xr0ta7pmur',
            'wmvz2yew0ctvjnkyg4l2',
            'fajwt5vrvrckrmpgqujp',
            '99fx42jfhshc4fyrwrqi',
            'ex2233bl52hidogic0o2',
            '8iipvwgz6b8mnw2c5hyc',
            'zosj67l6e7qrvcg83eus',
            '7s0h284xhgvuagyduc64',
            '299g4o8scuchn3s0z5ds',
            '1w7bl8sv8ie5okqqq1uk',
            'duh9u3c0u2zv5kluwop3',
            'mj6z9cpjkkv8hoytq2re',
            'ojhmyc1a0v18n2r60bip',
            'e42cndw4e75evp8z8s1x',
            'tk3xb6jz4p62cbg0feru',
            'swbkbibhcgm38413ekyl',
            '18as4t9xhsgdrytm4mlk',
            'zagld20u6od3u1pi4mq0',
            'ulaexqkh4v1kzh7gp3li',
            'bb1u3h4k9sd8m5jsb6im',
            '9gl97rmj7jy43mjjtwkw',
            'ukxemfz753ink65w4vub',
            '21edtbvcusgn1ocbtpsu',
            '50lw4remmy06zop90w5v',
            '5ebgtvuoohxf095m1ymx',
            '9fv1sog87929lkhof0jc',
            'jpvjbxxuxcn3ros2qlal',
            'n9h4f9ovurdrhylw7fwl',
            'pmwyksf35x1rkmbqx9jh',
            'z0k9r5xn6vjm4n6jspgi',
            'f3pmfzai4p8w332aq9fi',
            'gkk96t052ys9bnloq2yd',
            'z4jxrcdof7uyolyg4m4n',
            'y1i9mixv7sm3ahy6ky2r',
            'a5y46yncol1tknuvkfbf',
            'pfo483zgbohyu07bxfnm',
            'q57ezmenx0iid7g5om98',
            'xm1yn83og0p8h5jmk7is',
            'i3wf5pd6m66pjytaex42',
            'zdrx5i7h39xw45mk1jyq',
            '69cq7sbr4v8955jilcgs',
            'k97aac8xlhpr5yjfnb75',
            'dm77bvmpm1q72k4yfyfg',
            '4nu5plwf2upcesyobna7',
            'xo5cs2pc9wnxvrhyx1k8',
            'wzk4wwehvrcw4vo9etxd',
            '65uddgonslkd7vw3xaq9',
            'qvm0iqyxcxx5i759mumz',
            'lkfpmka25k5ee8wclpg0',
            'om96k1588f4fr2ivp81d',
            'jao7brvo8i5z9lb25sv5',
            'b057shi8py4awt22psp2',
            'oe9twmf6shp7v7s16ou7',
            '5z8dclxip3p85rywnddc',
            'oxi183ygulujrrgd2y9g',
            'zg7n47h8klqwqg3hbpe4',
            '35m3xosac8mvl0uyzvvm',
            'qedhw9ujanmrhthxj8pd',
            'vbrjq0wkknexiektnq6c',
            'cwiasrznyq4edt9lj1su',
            'qfnar3uu2bi4hszqrw2p',
            'hbwzh0w64tc5mttjof7d',
            'ex8bsht8lpb8vmo2ma9g',
            'g12couxs51uecqvvac0v',
            's6g0usvusi5836k6a8af',
            '6d7siur04rnwtkn8lv8p',
            '6zuycclarerakxw1zznw',
            'za0e7dgw7btdsh52pwz0',
            'lbv0ic2n2kw80wquehh8',
            '0w4is5xkzyfcc3i8suqz',
            'ekq5wvjt4s3izzi5xic3',
            'ehuwjxlkbfsmti1vt8uv',
            'hzi948znx6hth33qn1mb',
            'yqqmoypydyyq8hblofqj',
            'pvar281oii8mmbtqnfz6',
            '3dtw34x1kvn1adbmayq0',
            '0esn1fqv4vmjn9e3c7gg',
            '9dqzmgxb9nk9ru6dyo7e',
            '6t4dusdh2qpuxtpksshr',
            'myglsutk8xeb24vqie6x',
            'e0qz617vmbb6e4oeztge',
            'hx1tgveyz7rxfjtu3jxg',
            'ro60mnkbyoyvpirvzi6b',
            '2nee6d64zhtv23t7w6xc',
            'c0f5a3w9gggro62munbq',
            'hlxdt87l1zquslycuq40',
            'lyjcu6mpact0oczfjofr',
            'ud8nmd66h8l44s2fq30t',
            'cxfeh29q8ihns3imy7y9',
            'stiqsndhqbneyzdln5cy',
            'yvlhmkyw2rpd0pjmfoar',
            'lv4wq52khrz5va6caqxi',
            'qs8py6reth4a6x17hl6k',
            'mvy3up2mugn6stvvj1ki',
            'zhrksnqnvmpi0eqsbubf',
            '8b2za4reik2ujlttbqnn',
            'kdv3ideiisa6ata7t1s3',
            'ynszcyzvvrxac381d1dx',
            'u7xkbzucdrom2y5ynbtp',
            'rgtwir5f0oq3mnu8pnlm',
            '8kp40lnsn0yr0ymcvbt7',
            'o31xv6c1qcdnfde7q4cf',
            'lg918d3ibz4px4szifj5',
            'anayjnigwnqbicj7ybcr',
            'pokevyxxm6itxfn3as42',
            'x7ez3quad8w0mvafjv3r',
            'upxzs7pr55lornodj7au',
            'k9trn9yfl7pgn4514xv5',
            '0d4icc4c3827k4w1cp7g',
            'zeb1eqxjuyiadtfv5zlu',
            'u2j7znj5iaqbkfq37881',
            '921lw9ytepqpee0nb34x',
            'ob6jln2ql8awgqbzwnwm',
            '28cdyno7zn5uswvxb2uf',
            'gvcub2divutiq1z02odf',
            'cgiotdame14xk0i1xjt4',
            '9f42q5e6zwg1e4j35jo6',
            's4pak781pjk24gemui55',
            'h4mb49thbkfdbbb6df61',
            '3tsp7kue619iwre3nhvu',
            'fw9wtpswiiwekq4tukpl',
            'n9osr6ccbodh0sg9asj6',
            'stqby77coui4dnjkdjmm',
            'pf0xcpkndws9sqb5bbhi',
            '0p4zxo7ft4g7v3yw3oda',
            'fhtvh507kx7x85rqjiau',
            'oeniuymtklr9bf5on4ij',
            '2zsmrgrrim5gcm26n1xr',
            '1gbcvfxxzr58puz1cpq2',
            'o66rete3wn7qhet5d27h',
            'kpienzmo50ml1ru7y2i5',
            'l9wfzzzyx9k3s78sxree',
            '8yhofwnh2bpkd3c0mhnz',
            'xnz2lty0dbv6syhdpzua',
            'b7u6lju0djz2m4rlsuma',
            'axil0prswfutgsnq9f97',
            'mm0tvntd0sxdso7sb4d4',
            'lxauzbke6pyojvrf0q16',
            'bg3zxfd9lw6fw7154o3t',
            'rwlf7v5sl3qdggrve5gq',
            'kz31t159w9ecns7wnjwa',
            'f8n2o7kusy5v0d53ohka',
            'lmv3txsufgnw6924x90h'
        ];

        $j = 0;
        for($i = 101; $i <= 300; $i++) {
            $out->writeln($i . ' - ' . $names[$j]);

            $mustachioPathfinderMarauder = MustachioPathfinderMarauder::find($i);

            $new = false;
            if(!$mustachioPathfinderMarauder) {
                $mustachioPathfinderMarauder = new MustachioPathfinderMarauder();
                $new = true;
            }

            $mustachioPathfinderMarauder->id = $i;
            $mustachioPathfinderMarauder->name = $names[$j];
            $mustachioPathfinderMarauder->description = 'There is a land, hidden in fog and wary seas, of mustached beings. Mustachios, they call themselves. Secretive yet adventurous. One among them fabled yet mysterious. The bearer of the Golden Mustache and keeper of the Grooming Kit. A collection of 9 mythical artifacts, each one he sought may it be in the deepest of caves or atop the highest peaks where only eagles soared. The Prospector as we now know him. A legend in the land of the Mustachios. The voice to tell the tales of the MustachioVerse. The emergence of the MustachioVerse portal is nigh, MustachioVerse beckons you!';

            $extension = (in_array($i, $jpgs)) ? '.jpg' : '.png';

            $mustachioPathfinderMarauder->image = 'https://ownly.market/nft/marauders/' . $fileNames[($i - 100) - 1] . $extension;
            $mustachioPathfinderMarauder->attributes = '[{"value": "Marauders", "trait_type": "Generation"}]';

            $mustachioExists = MustachioController::check_if_minted($mustachioPathfinderMarauder, 56, '0x7De755985E7079A07bfC4919c770450436D413a9');

            $mustachioPathfinderMarauder->exists = ($mustachioExists) ? 1 : 0;

            if($new) {
                $mustachioPathfinderMarauder->save();
            } else {
                $mustachioPathfinderMarauder->update();
            }

            $j++;

            if($mustachioExists) {
                $collectionId = 9;
                $token = Token::where('collection_id', $collectionId)
                    ->where('token_id', $mustachioPathfinderMarauder['id'])
                    ->first();

                $newToken = false;
                if(!$token) {
                    $token = new Token();
                    $newToken = true;
                }

                $token->collection_id = $collectionId;
                $token->token_id = $mustachioPathfinderMarauder['id'];
                $token->name = $mustachioPathfinderMarauder['name'];
                $token->description = $mustachioPathfinderMarauder['description'];
                $token->image = $mustachioPathfinderMarauder['image'];
                $token->thumbnail = $mustachioPathfinderMarauder['image'];
                $token->attributes = $mustachioPathfinderMarauder['attributes'];

                if($newToken) {
                    $token->save();
                } else {
                    $token->update();
                }
            }
        }

        return 0;
    }
}
