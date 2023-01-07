<?php

namespace App\Http\Controllers;

use App\MustachioRascal;
use App\MustachioRascalMinter;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

//
class MustachioRascalsController extends Controller
{
    public function getMustachioRascal(Request $request, $id) {
        $mustachioRascal = MustachioRascal::find($id + 1);

        if($mustachioRascal['exists'] == null) {
            $holder = $mustachioRascal->checkIfMinted();

            if($holder) {
                $mustachioRascal->update([
                    'exists' => strtolower($holder)
                ]);

                $this->checkHolderForCustomShirt($holder, $mustachioRascal);
            } else {
                abort(404);
            }
        }

        $attributes = json_decode($mustachioRascal->attributes, true);
//        $isEarlyRevealed = $this->isEarlyRevealed($mustachioRascal['exists'], $attributes);
        $isEarlyRevealed = true;

        if($isEarlyRevealed) {
            $uuid = explode('https://ownly.io/nft/mustachiorascals/gif/', $mustachioRascal->image);
            $uuid = explode('.gif', $uuid[1]);
            $image = 'https://ownlyio.sgp1.digitaloceanspaces.com/ownly/mustachiorascals/gif/' . $uuid[0] . '.gif';
            $animationUrl = 'https://ownlyio.sgp1.digitaloceanspaces.com/ownly/mustachiorascals/mp4/' . $uuid[0] . '.mp4';
            $model = 'https://ownlyio.sgp1.digitaloceanspaces.com/ownly/mustachiorascals/fbx/' . $uuid[0] . '.fbx';
        } else {
//            $image = 'https://ownly.market/img/collections/rascals/breathing-idle.gif';
            $image = 'https://ownly.market/img/collections/rascals/walking.gif';
            $animationUrl = '';
        }

        $mustachioRascal->image = $image;
        $mustachioRascal->description = '[Download Mustachio Rascal FBX Model](https://ownly.market/model/rascal/downloadFBX/' . $id . '). Another set of Mustachio adventurers are joining the Pathfinders (2D and 3D Genesis Mustachios) and Marauders (Second Generation Mustachios) as they explore the Metaverse! Here comes the Mustachio Rascals, the next generation of our Mustachios. With a maximum supply of 10,000 Generated 3D NFTs, the Mustachio Rascals are the third generation of Mustachios. Of course, you may explore and play Mustachio Quest with your 3D Mustachio Rascal.';
        $mustachioRascal->attributes = ($isEarlyRevealed) ? $attributes : [];
        $mustachioRascal->animation_url = $animationUrl;
        $mustachioRascal->model = $model;

        return $mustachioRascal->only('name', 'description', 'image', 'attributes', 'animation_url', 'model');
    }

    public function getPreviousMustachioRascal(Request $request, $id) {
        $previousMustachioRascal['name'] = 'Empty #' . $id;
        $previousMustachioRascal['image'] = 'https://ownly.market/img/collections/rascals/white.jpg';
        $previousMustachioRascal['description'] = '';
        $previousMustachioRascal['attributes'] = [];

        return $previousMustachioRascal;
    }

    public function checkHolderForCustomShirt($holder, MustachioRascal &$mustachioRascal) {
        $customShirts = $this->customShirts();

        foreach($customShirts as $customShirt) {
            $mustachioRascalMinter = null;

            if($customShirt['name'] == 'Philippine Web3 Festival Turtleneck') {
                $mustachioRascalMinter = MustachioRascalMinter::where('address', 'LIKE', $holder)
                    ->where('type', 'web3fest')
                    ->first();
            }

            $holders = array_map('strtolower', $customShirt['holders']);

            if(in_array(strtolower($holder), $holders) || $mustachioRascalMinter) {
                $balance = MustachioRascal::where('exists', strtolower($holder))
                    ->where('attributes', 'LIKE', '%' . $customShirt['name'] . '%')
                    ->count();

                if($balance < $customShirt['limitPerAccount']) {
                    $mustachioRascalWithCustomShirt = MustachioRascal::where('attributes', 'LIKE', '%' . $customShirt['name'] . '%')
                        ->whereNull('exists')
                        ->orderBy('id', 'desc')
                        ->first();

                    if($mustachioRascalWithCustomShirt) {
                        $tempAttributes = $mustachioRascal['attributes'];
                        $tempImage = $mustachioRascal['image'];

                        $mustachioRascal->attributes = $mustachioRascalWithCustomShirt['attributes'];
                        $mustachioRascal->image = $mustachioRascalWithCustomShirt['image'];
                        $mustachioRascal->update();

                        $mustachioRascalWithCustomShirt->attributes = $tempAttributes;
                        $mustachioRascalWithCustomShirt->image = $tempImage;
                        $mustachioRascalWithCustomShirt->update();
                    }
                }
            }
        }
    }

    public function isEarlyRevealed($holder, $attributes) {
        $customShirts = $this->customShirts();
        $isEarlyRevealed = false;

        foreach($customShirts as $customShirt) {
            if($customShirt['name'] == 'Philippine Web3 Festival Turtleneck') {
                $mustachioRascalMinter = MustachioRascalMinter::where('address', 'LIKE', $holder)
                    ->where('type', 'web3fest')
                    ->first();

                if($mustachioRascalMinter) {
                    $isEarlyRevealed = true;
                    break;
                }
            }

            $holders = array_map('strtolower', $customShirt['holders']);
            if(in_array(strtolower($holder), $holders) && $attributes[8]['value'] == $customShirt['name']) {
                $isEarlyRevealed = true;
                break;
            }
        }

        return $isEarlyRevealed;
    }

    public function customShirts() {
        return [
            [
                'name' => 'AMAC2022 Shirt',
                'count' => 50,
                'limitPerAccount' => 1,
                'holders' => [
                    '0x39010A5117b7401B78ca5F149Af2DC320ACF5EC9',
                    '0x66E7c903C4613643B70FdB1d8ae08F265037F2A1',
                    '0x645E8537A6252Aac5BEb1CeDE014E6b21894242F',
                    '0xe700754765d0B72A8B6A470408BC79fDf4Dd65F8',
                    '0x729C13aF545a476a2139FB61C5f3b1e554d38D98',
                    '0x5c472CEC3a81aC1F524c9d5229B9FFdAfaaF97a3',
                    '0x71f09fc35a096b48d830Dc775B942E613bd575E3',
                    '0x7948B2c1b2AAF91452f4Af0B8Ad0C60443bf849a',
                    '0xB831C4b3fEaCD327E3E16CC6330061B86A693Cb7',
                    '0xF3309975C3Ab758E8b3937f5C524002EB09AB5eB',
                    '0xb79191b8fa6e785d848a685bf559218acb1ed5ce',
                    '0xf2C0499E209acd8FfF122f5B4E93E54C2e0b0ECA',
                    '0x72C3346FD437FFd310Da17e6BbdF2488552d0fc7',
                    '0x265Dd3fcFDDfe2cb7c609501A6a5CE37e5c25EE9',
                    '0x6ADa179D281DE558f8d5CCF1259074B029Df7b5E',
                    '0xd3f3C170127A3ec454faB3d74bb4062aaF3688C4',
                    '0x4310e19E1195c77830069Bb69e3954752C868030'
                ]
            ], [
                'name' => 'Blockchain Space Shirt',
                'count' => 50,
                'limitPerAccount' => 50,
                'holders' => [
                    '0x9e61c42166e32c257e8f154be061645f975925d6',
                    '0x63a71444d6cb077fd9ad1cddb852c587bb3f1fc5',
                    '0xe27851aaea36a0e3940a059bcd7ce083fbe6c307',
                    '0x4755d63f5b81bbbf72804f6f15b69f2920a24d82',
                    '0x93e5fdea32f4533946f0840938e533b22dc586bd',
                    '0x8195546d8c32f58fe5338c841538ed442c06adc7',
                    '0x9d9588c082634fd4c7f54cb0243d6792cfd7b4c4',
                    '0x0dc874fb5260bd8749e6e98fd95d161b7605774d',
                    '0x007abdd190137f614701a6216fd703329afbcdf1',
                    '0xb3ddba238c12bfe3e548f43d915a0f11bd30b798',
                    '0x510a7cd4ba40f7b6643f566a5d45ea55f5cd8d0e',
                    '0xc02ad7b9a9121fc849196e844dc869d2250df3a6',
                    '0x6b339824883e59676ea605260e4dda71dcca29ae',
                    '0xde9caaadfeab5e9cd92f1b4a24ade7bccab9b5f2',
                    '0x4f8fcfb15c1070f1362a584c109ad30b2e0b827e',
                    '0x404d846c95b2a70104fbae9797305beaa27a4062',
                    '0xf8a367e0f5d3fad40039f10b39ed28e8f9fa625e',
                    '0x617b4174d7e209b6bcac5b2c2836a14d90070b0f',
                    '0xe30ed74c6633a1b0d34a71c50889f9f0fdb7d68a',
                    '0x7f28b10bfa9475f1ebaa70a3dfe400ca01166333',
                    '0xdb2a753e49dd4fdfa477a759990f0f8286580b9d',
                    '0x9dcc35ae915926f7f5e8c624254d91f755d55b71',
                    '0x9d0e43f73eeaf9b2d36c8a33857883c77abd49ed',
                    '0xf0f79a39b0026263ac700e58ebe7023280a3a57a',
                    '0x896b94f4f27f12369698c302e2049cae86936bbb',
                    '0x4bf419634bbcfbba096f780cff10858ac2cb6dda',
                    '0x8aa25ef2c43f0afc214ed7263b6abd189dc18594',
                    '0x00e83f5269ef1dbbadfbc8e63b168904edb71f41',
                    '0xe9757e2660a89a811b25fe2aff3cf995c88e7934',
                    '0x7089829adebe44542653fbbb47dabc4cea93677c',
                    '0x56ef2708ec0448b0d9f4612fac3376cb0ba7aa7a',
                    '0x0d24f692c05036602076b3f51242b5a34c55ee38',
                    '0x437a1e2ee929ee663cf6071f7289bf9a6975b988',
                    '0xcc3e0238ab75ce515e7be86112c0f2386a672796',
                    '0x64ac7489a815408e887014b1c6af7ad45ab2bded',
                    '0x28aee851e7b65a46b71de302cffeeb2c557847c6',
                    '0xc6d4e5c1cd5c2142c4592bbf66766e0f5f588d84',
                    '0x7954af6cbbd93dae4de8d8be4bb5a8eae5656106',
                    '0xbdfa4f4492dd7b7cf211209c4791af8d52bf5c50',
                    '0x0221c3cdb3dc4ffddb0564227d205b7f0cbac1cf',
                    '0x3b78fd35e01750d09960cd62930c6664c2b228a0',
                    '0xabc38177643fd205c3f3e256dfc1e7ad4024808d',
                    '0xb3654f0fae2ee153c64add91d6506f4b1efd5ee5',
                    '0xf07f9762d375783585f143f0b5b6168380854307',
                    '0x1e6b64e409de69217e97150256dcecfb0a38b569',
                    '0x9c6cf02cdafcb3e6a8c55defde526f17c5287a74',
                    '0xad55c057c53475f0c81adfbf04a0f382bde37d10',
                    '0x1621c4f772b284dd71052e882e197366e1faa942',
                    '0x423dcbcaa9ea7de2da9f20a6b9dc8bde99e137e2',
                    '0x9354ae6f065e900a1f07b95119edf12731cefa7e',
                    '0x93f57ede320cdedb0aa8b3f8bb079fce468357b4',
                    '0xfca93777e2617e32eb8b2df5512ec864c5f1d6d2',
                    '0x1fafef2c8d8cf8e9a2e6ec8558c280b7b5812678',
                    '0xeb701dc64fcbb1b360f08ec5a39156c2b80bc76b',
                    '0x0a2a321fc1308de298c4edcdf3ed749e54bb0868',
                    '0x26083756004ad6e370224432c954418700b12700',
                    '0xe1a83c678e6ca74f779de0507408ce368a026ee9',
                    '0x0b6649a92d6242061517a5198a264c664798b918',
                    '0x2db752e3beab7ec48735bfea65edb49a9a93a173',
                    '0xe8b55fd62045d51274812e5c3ab803055c0e3eaa',
                    '0x023996f7d5d6fbd4f10ecf6253e9f8da44e57a19',
                    '0x07043ced05afa4456db015fb43fb3c99e07b07d0',
                    '0xbed7fc5a011cb6ac5a14fb86c1ba893b40acf1e5',
                    '0xbb937b0405e7ac48f982500afcb389c8dab4d589',
                    '0xeb034756a209c6b2d2afb9811302d8c0026c64e0',
                    '0xcdc671dc72721f87ff0b6df538344cb7ffa0745a',
                    '0x21847fd6e6028f319a367acfe28ae9eb9213dd55',
                    '0x537bf75de19f3d229e3a9018ee1a23c0c9c7d39c',
                    '0xea08a31c8d938b11f7b40ed6ac651b63bcc03a60',
                    '0xaeaf118a22233d9c71648798e78c7d3b546bb0b2',
                    '0x8e79a50d1222f9558686e758e5258fb352a6e14a',
                    '0xf6e546668c397dcb64767efe331904ba147d5025',
                    '0xa15978b39a0e0bf54e0ba6533ac8ff24f1555d25',
                    '0x9b9315d667be52f0b4036e79253d30ac05040f94',
                    '0xe92f359e6f05564849afa933ce8f62b8007a1d5d',
                    '0x17a9eaaf2c8300f281163818b589b5ae708ac8f3',
                    '0xcc85d3b7fb301d347ff4b6139e47f5a65a09b709',
                    '0x88f12594aa12fb5f85a402b9b4588750ac915cfb',
                    '0x20eadfcaf91bd98674ff8fc341d148e1731576a4',
                    '0xb67ec82cb18fc6b593ade83fc5025c480ed51b7e',
                    '0x4f95ee90a5017fa8f9c972f9b3a839ca63f72a91',
                    '0x401bf173466a20d84683e6e81935a8be3b4e0338',
                    '0x64874f2c70c125d300a1949ad57cbd65d5921122',
                    '0x386a3744bdd5710569469351baabac580bb65087',
                    '0xa527ec807541553bfa5c99c1097bda0293c7aa5e',
                    '0xbe0958fc1888506640968652ba73eafdadf79f6c',
                    '0xe1b855d77464cc3fe36a510a2785bf412a0ed3b7',
                    '0x052c2cae0c5acb353e35eeed1de6cc9c6863d768',
                    '0x3f86f18322a888d9b3adef38f127c941bccc014d',
                    '0x497c8f60b8955f6b45b2e247ef1c6719aa745c82',
                    '0xfbcb942c5d8c04c937ba6f3e15a09e944b371611',
                    '0x0645736eecfe8b572cbabb885eaade641b659846',
                    '0x644e6abb3f9e8754bd9e07159f4ee7d5e3c5c4ac',
                    '0xee99c0b1df8fabd9acd0cdae72048c060d58e920',
                    '0xf1d47e8f07810fbb060e25cc98ad94909abc1c96',
                    '0x2d14bb9d4b32060b4e38cedcf05b7f883186f47e',
                    '0x2fd2c3f7c1a6f5a8e3e0bc6e898eae75ad51864a',
                    '0xa9acd2b94f4f4b69c79187b152b67cd0c35010f9',
                    '0xd8d4db2c2c882b61b1d2516d9fb55e3ef61a5998',
                    '0xc8730ca25b0f2d71ebdca99cb5a8280acbab7505',
                    '0x23c0954c4b997c58a1544717de90c8e174ea194c',
                    '0x368385da2663d99795caf9b628bb8b792e6c58dd',
                    '0xf271fca7f2896c43db0251676c5bfc61e6e51042',
                    '0xaeec91ed89433d4223ca83aa0b1893519bdde06a',
                    '0x04487655d40e07fecc1b5f388d2323a5a13b2ef4',
                    '0x815070a584d52384a1cdbff844a38ae657e93ac8',
                    '0x2a344926b5c4f6a0b47212f0876beeaf10bb5888',
                    '0x4927c1dd26d0bfe25a352b08fe5fb847494261fa',
                    '0x50bec6f02aa38577955e3d595137b335fcf1a822',
                    '0xad3bbda40d6bf9ce9488a08ea478081110a6ac43',
                    '0x2ef33521f840ccd142003e8946eddfdf5158e781',
                    '0x40af68008a4f65003a7e0ff283eed218195dbf39',
                    '0x73b0ada6fc72521316e97306f059852f808fcf5a',
                    '0x24a1da60f419a0e9db709e151e6e6d00d341db80',
                    '0xfef355d66a41f17729aad1cd233d2d5e7af0961c',
                    '0x1b54e9460bda14bc17df5623e674c9ea7adaa08e',
                    '0xc5958a9c4f7169cc95969849a6065beadd5322d6',
                    '0xeb618372fc69b0f390d2947aaf22e254f0615977',
                    '0xbfdd960844765b1bac0bf1f01a84fb1f5aafe9bc',
                    '0x9a987ceba1fedf87ca1e2cb3296a01f5862176db',
                    '0xbe761779a9063be8f9856424cd12d58bb8e25e06',
                    '0x5fbe4f5c099c31fc988d8d9eb01e35734a23c943',
                    '0xb128d6007d5d0e9b341f2c66e9ae482304fb7fdc',
                    '0x468cb54a3821d8b0129c42ea6adf12748d97fd98',
                    '0xa1966f5df9be1cbbca1b70416043284f16d0aeba',
                    '0x1887d97f9c875108aa6be109b282f87a666472f2',
                    '0x3dfb65035f2648cf5d8ef6ded2694b01509fc408',
                    '0xc524ed0fd1af56ce04becfa8ffbc73ffc085be3a',
                    '0xc6b72c2253ed7db14da03e7044f0f4362bc5b2a4',
                    '0xa0ff757077b5d796259582b2b9db99c906277007',
                    '0x6e14d4e15e245d6ecfe3181b08c2ff30d2c1da19',
                    '0x056ecff314c33aa5971a5bfceb80ecf1ec790ff0',
                    '0xa787a56c43847a3b5a0110d0b5e004e47f57b22e',
                    '0xe92d80a90bc050a12f1c6fbe0e50e1b5a874b595',
                    '0x5730d5c062fcf9cf2fc5ee81f3be26e0a580cbaf',
                    '0x57824a0dfac947483709e6b636f6afcc2409434f',
                    '0x90721a8e13cc9352971d5841bee6e3c03108ffb5',
                    '0x57a91b957cb6181acdec157bf4227fc2d7dd37f6',
                    '0x5835a04c07a68f2fbc4e415cfc2217d4fbc8546d',
                    '0x5855aee79151f96d9c29f15fbfba283e49977bb2',
                    '0x58940f6b48a5c92e9a02ecfafce04275f2e589f8',
                    '0x599f877afd4abee50c0bfaf60c7e7ba809bc4b8f',
                    '0xf0135e045042715d255ff2086f4e3198c64922be',
                    '0x59f37798dd1029dfbd6a405ed7e5d2ca53f1783f',
                    '0x5a89517276792ac46df1dce1c8a965cdf706e71b',
                    '0x5aa36b008b3aa5684794b3eb6ffafa598d351195',
                    '0x5b011de06910c4ddeb0bb683fada1cc0fb74e59d',
                    '0x5b63a1a2b3d2d7041dbfb68467f182117f7340a5',
                    '0x5b76d22148d8670f82892bcf88651220206bb156',
                    '0x87f1f1f22f02c46ea3649a326cafba2c7a1df6b1',
                    '0x5fb0ff16ed9a863320b3afb11ab713dbfca08497',
                    '0x5fb726d37bf431897e5b191a8cc646eb52526c00',
                    '0x9fbbb67b91f2c24dab675626af32cadb90e86186',
                    '0x9fabab67963d319700b5927fb93debfa2821726d',
                    '0x9f676862a902bbcd00ef550d6acaf461ce5fcbd0',
                    '0x9f6a580d92429cb4636ad55ca9755f73c40ec0b9',
                    '0x9f76930cc03ce1088a00f43947478b7c296e73ef',
                    '0x506f7a9e1dad92983c8e1a5ac3f6ec783eca860a',
                    '0xa0bd707e367284ac687181020e78818cd79915df',
                    '0xa0365179fc42681cc4c5b5b513be47d6c9e6d7a4',
                    '0xa00792f612077f578e6a18f09491ae9c1773ee1a',
                    '0x0d1dfdb5b7df4c191d48fd2d8e2696bb99bf081c',
                    '0xf2dcc36beab9c4a258d1545e9692d7a97b68d5fb',
                    '0x00a10a48cecf14c197bdeb4247308803b54475d4',
                    '0x0355d7ec330930a5060bfb50843bae85d85d268c',
                    '0x036eb991d3c8b8a970e4b768911c86e1c0f8c5fe',
                    '0x043c4db076c544493d40228b5fe06e6b0271d363',
                    '0x046b4a85c2f739b6fc043ec2b8d46e73ecd050e1',
                    '0x049a24ec540466bf0674094c2f7c40ca264ec6b9',
                    '0xaa40389c9478f19587e4c6cf70e0439185efcdd1',
                    '0xddb904715662aa7978176e29c5c1a83c7e5526aa',
                    '0xe278bb74634818ef6290f0bcfbca20a07be742e1',
                    '0x577c04a65db999ac1be49409c45099c44ddf4227',
                    '0xadae21550cdbb8f54b85c14cea6cf4635f5d5296',
                    '0x0867d582100f1c7dff4cb8bf3ca2cbdabf471975',
                    '0x8a61c782c1fa00cd8e670609bbacae412316f1e9',
                    '0x9d4a0044d4e0967e4f67ddc07e88b0bdb1895aea',
                    '0xe19843e8ec8ee6922731801cba48e2de6813963a',
                    '0x2ce2717713c22616025ab42e0e237539150db5d4',
                    '0x85f5f09db583e45ebac05cd9a10370279804222f',
                    '0x5fff6d94cb6b7455eda0f0266393a8972236cd81',
                    '0x600085c6d143bdffe829292eaf96fbd3c4e3d3d3',
                    '0x600558c5bb6fd7f38bc0544bb434ba4e78392227',
                    '0x6027fa29239c92d2ef779228550423408f3e606d',
                    '0x637692b814af42b4cae053eaeb839ebc56e93d31',
                    '0x638ea8d30da2a220ac76596c9071f2d84fb878f0',
                    '0x66e5758236e5d25d46a1186ccd471d2d291333c9',
                    '0xa799360ef7da052200d14c7531a490fa58f73bc6',
                    '0x63b848c4e19c564aa76578eae563c5ce2062b100',
                    '0xa79d2bf4e2a0bd6681c989aa365c5d2541b54703',
                    '0xa8213923bd344472f926ab2cb6eaf57c0b8f19b5',
                    '0xabc66bb525013f9450b31b070c1a67e49efd896e',
                    '0xd5db346f9341d0ab0266d91615777ba4b65fcdca',
                    '0xc6706336e47963bdbcf0c84bf355b1a989a2831e',
                    '0x250b9dabe03409834b56240d088d91a7dbd2667d',
                    '0xa395bc182f658f5f93b62b3faebdb5aba47fa04d',
                    '0x928bff9ecb17dea39f8d792ef3c66e06d354c7b6',
                    '0x26ed288b6aff39041482625a151b9516c3b0a359',
                    '0x92a81211fc06ee05cccee26143b92ca351421909',
                    '0x939848c01663bf2221fe5b1861a052dcb5accbff',
                    '0x93a755808694c187a39c52602693d18a1c8fb29d',
                    '0x174cb987c299a56f04e38510a0fb7294283ee226',
                    '0x53851577d7c8fdf83831d604a40e8c85555c108f',
                    '0x81d98c8fda0410ee3e9d7586cb949cd19fa4cf38',
                    '0xb4b002c933da2af4a3709113ceb9ada8a14d121a',
                    '0xa4b1a45ca22205d3c2ef4b21bc464eca2046605a',
                    '0x3f71acd810ff614ed484930a21e181f828030d1f',
                    '0x2be3cc1376afb118d83b65ded2506a80c0b433f6',
                    '0x9763ff3ce848511035d58b91c7a4942af0dcb534',
                    '0x9791d7ef0dc1d7cddaf7a5e9102ffd0881297c91',
                    '0x9a59e9425f527346c1da34ea1898e6125f0cc10c',
                    '0x9aead8474659f5abb987f03503150ad1e01e1f03',
                    '0xb516b0bd79f2eaf7cee03704580e38c8c3e9a954',
                    '0x997b04d059fc821c47a0e9a7328e752e0d8c599a',
                    '0x9b49b933bc00d07221726551235b013f6d038f09',
                    '0x9c585631d4b69ed2f24c212f62643d419b13ab2f',
                    '0x8bfc0915ba9be6686798aad254c1bc06c4b7bdb7',
                    '0xb5fc32dd1f6401ad53b3adf42d174826bab9cfdb',
                    '0x96564e957f0a00566919cd561dc3d343d46daa2e',
                    '0x1e96bf7b649bc11259ad300d390ba3618ab7bb01',
                    '0x96168c15b6c4f8bc7cb7b161d1f2ca2b5878ccd5',
                    '0xa35af6a15034ff599ac123a92a8844f379e371ce',
                    '0xa36b4aca1f6e869597b2cfada173e2cfa69a98bb',
                    '0x95434378ab28b853c4734c1340ae6692d9296206',
                    '0x963f62546721df3250355883e2002a103461f2ec',
                    '0x94792a78bd4fd8d542c1628d5cabc622af757d60',
                    '0xf32719bd3683ba776fe060b0a216b6f95acd2805',
                    '0xd780bf1fd6695ee2e1fa7eb41ae89f0ebcd41220',
                    '0xca5e2ca7ce80c3b9bd736077ad2ce9e255eb2c42',
                    '0x0267f396cdf4d7f6d32794f578b227159ce89f5d',
                    '0x032807e684c85d1592d9bc91952fd13389da0076',
                    '0x0d15a568a73be914287c15d14bb8fa6c79f9624e',
                    '0xd2288500045e9aacb33a603b768145e12aa0d097',
                    '0x2c05a3266ad172e5bb38e988429042ec8b528c8b',
                    '0x73404719f5e63c8e63cc188a6571b3c4154ec4f4',
                    '0x8f0609a2e94527b11f83be89c306455536300c9f',
                    '0x5690436f388fea51a034ed60e88da787e41719b3',
                    '0xcfbbd4b24ad36cb82ce4eb454eedbfdbac692f44',
                    '0x69a083ca2ba086d6d5b35ff2eb6cb3531fe2a446',
                    '0xdc7409d2f8dddeb783af621a6318cbbee9a79f15',
                    '0x13cbe0d86e537001b0a898f04685c8961bbc3e81',
                    '0x49c72406788d175f6724b599de6bf16592ffbc35',
                    '0x77d18fa7ce0dc1cf945454ef693d3dd73137268f',
                    '0xb11ad90f2170d7d7bebb046b3811cc7e18e05ad8',
                    '0x8af76fcf8c3999a3f482e8adcc2bb1b2c4346d29',
                    '0xae2830569ce3ec7065a09d8b74530163dcbe305d',
                    '0xb1c7f3f10a1f6922f90c7010e7438adfdb23ee0c',
                    '0xe3fb0afe40b1f58cfb61e0828c921f940771396e',
                    '0xd99628b3ac72e7d4570a4947151a2a19e3c1a0b1',
                    '0xa454b7cdf074e4eff53d3e95aa8aa119fbef09ac',
                    '0xe6d72f08174f584c2fd0d72001a920516c6b9afc',
                    '0x964051c2e5e645ec028c4bdd1a1c96a5c923a756',
                    '0x5a2e0deefcc357d52b3dcac88d5f0a6eaa394ae8',
                    '0x0064dd1840a0e5284280244f2da76aef484c6cd3',
                    '0xc196046e95dfafbb6c34fff82aa7b9362a78879d',
                    '0xf5a1cf0cf023022bfa41c48a1c5ce58b1fcb806c',
                    '0x9c60f4fb419273e65dbb41b221355f761a3276d4',
                    '0x2b232939041c5689eb15614e1081082d5504d283',
                    '0x719ff8c166d8ad600030b35a7b3ba315dab80b11',
                    '0x51c4f82559e58f6f6189ad415c75ca57cbc44a48',
                    '0xfa156c37e5698bc7a5c19335597dfc394bea1f39',
                    '0xc5b546ff4929f30e48492516aaaee286908bdcad',
                    '0x9088651003e06d0262dedc086025ed09b4647687',
                    '0x76d281739298e4e929ef2853b6645780060a5851',
                    '0xfffa1ebeeb57f3ffe1ea94858d0d392b46994257',
                    '0x8d73a0e46c250ed1fc7ea8e802a26e64c8b09bd3',
                    '0x8533cbe9aa72f852ab821d7ad8223db01d4bb326',
                    '0xe1c911c8df63db14b40ebbd9ed7fb4a9c8251b7e',
                    '0x51bcdbbcfcc32bb195e8ddff357a1be948de2102',
                    '0x9cb42e42dd5ce74b1de89dac3c1b5b00a212daaa',
                    '0xc467b0c4bdb26a5942ee09b12d01abb8b9ecc11c',
                    '0x9bf65fd28c75ee2d7a5a3f7e74ea1beff6d9c2f7',
                    '0x7f7c49b0880f7c67f26cbb8c341b6b4aaaa40c0e',
                    '0xfc92f989d0882acdb4c9f263d6283064be2fcf50',
                    '0x292c049ef71cce589b4a6adc60b4399727d84d46',
                    '0x99064a1d97784e17dbf3036f03ec4e1a89edb385',
                    '0x8b4583edcade6490905000c5cf0daa1b92be2773',
                    '0xa8795845e08f244215e243acd66c6597bbca0f6b',
                    '0x4e1a38183883ff746eba256101d2ffe2de286817',
                    '0xfc44c6a99cb1fc8f2cba14a097c33f450c3712ba',
                    '0xa141c5f1321cbc998f94b570cd4cf7f632f862c9',
                    '0xe967b2771941283e2926a949aeec9e195b0fe14f',
                    '0x89301cff8ea69e72ce53b0aded0fa36f64f9267b',
                    '0x500ff7d07908e7f8aee9b2669082b47ac6a04885',
                    '0x15f4c337122ec23859ec73bec00ab38445e45304',
                    '0xc89cd65589f008b8284b1ccc0d4a027934283bbc',
                    '0xd3c2506a9b384490b6878bba1456c9b27a5c526c',
                    '0xecbde5878a4127b8def2af355dc7e2be5311f904',
                    '0xd679b9aa93a5c47a70e8658a0a18f689eaa61eca',
                    '0x49c753e8ad63a851e2fefa8efa9d45f0056e4abe',
                    '0x352111f0b57d690299672007b45a077ef673636d',
                    '0xdd532d1b03a14ddabaa2a46396094cb585300c03',
                    '0x788a5ab87d7f8de001386d1d65844fd26c317b7e',
                    '0x8a2ec26ce162f4fc1705ef380e3a785bf5e41dc6',
                    '0xa80fd8985165e331bf933d27318b2b938b839f26',
                    '0x289d545e52b97524278f94672d2be8c44eb3f369',
                    '0x4bdf57007be460b851575d833d6b4ca0621a0526',
                    '0xb623f72c6611443c5cfde5bc4853b8df6d726f20',
                    '0xa854e18f192500133a728004a1c8ce10d9d91f8f',
                    '0x2ea91d600364d77053ca0161424298be6b0379aa',
                    '0xf4ced5c4bbead85bbde1d8216eec6fd9eb919d6d',
                    '0xb811dc71af7d9242a161d43318a5ca685f56f680',
                    '0xa911ccf5f6c7bd5fb25188d41a536890c3c8fae5',
                    '0x0f2cd0c6474594b2d3830e1076f40d6828641a0f',
                    '0xdf85582a8ab1138d674bb5f301ff6b228e02257c',
                    '0x58a61c0c257c76191a007074910758a524fc7268',
                    '0xd2a2f88d6823cd9fd36f354808b4d043f7e86b5b',
                    '0x5315f835d7f66125069f05b1b8365338cb193dee',
                    '0xeaf3db6fee61e3f48faf57533763cf85d55d224f',
                    '0x7ef88b24d5fc428e49536cbb70b4d1b70d8ce31d',
                    '0x711281c1b26aaed86e40e4caaf76c1962b45e161',
                    '0x42cafb19f1f79c6adc2604ed54ca9e0efe342214',
                    '0x683b0fe373e8fa4bc121902c77f2ffb777246b7f',
                    '0x56af52a9611afda072a73afd0e1ff4c4e35ee94a',
                    '0x8289e0a99202ca6f2491f9972b1bcb19014a86f2',
                    '0xaf257344c8013837e9ffc9d596cac5ebfddd920c',
                    '0x7c497e0016a5a763cc0c24358d2dc1e610bdf651',
                    '0xa2db2e74090716c11fc131244ee436bf4a346dfb',
                    '0x0540db24a0b7d9f1f70e915a1e4c4913cdd0e3e0',
                    '0x8323ea41885680bc2dee1b879dff60f75b1a90a3',
                    '0xfeef9d78980083f605c9902c0367df6035d47276',
                    '0xbf62613201c7af9e9254a35f54f85710ca04a815',
                    '0xfd69ab949039579492befb5cc17a391f85709e41',
                    '0xd4504dd3b8bfba04026f3db13c5c1115ef978fce',
                    '0xfc8c4f31b465ff73c0d901db475a995df0fd5a5d',
                    '0xa98d183844be8a9b933a0a1eeb615df8586ee4a3',
                    '0xbec3ef697f58795b33dcbd6e6eb8c9992560c815',
                    '0x1a7c470f9f349443b9a58c9d8252a6bdb61566a0',
                    '0x721931508df2764fd4f70c53da646cb8aed16ace',
                    '0xcbc853efcf3f0a78c6f52828ad6a8091a8b302b3',
                    '0xbdd26680f995983389c9a41793c1fdbe6d8b2ae6',
                    '0xafab5c00089c9cd7898a53c9924f9126757cd9c7',
                    '0x09c3ab71778a2ae29c9610d3e489e755efae51b8',
                    '0x22cfaead8d65822a55c9222d6c18bb91d2f69eba',
                    '0x1640555d9937cec3b9cca3225edbe9771b1185ec',
                    '0x9f62257406227b87724ea6b049cfab63c42df407',
                    '0xd8be89d2acd6b7fee506bd98213c0d849af44b76',
                    '0x690e3c4713546f346954ceb838a3f34c86e0be05',
                    '0x921d93f5f7deaa91e98163a34ad9ccbf315380e6',
                    '0x56866ab98d3aafeb7c96b6f15f57120db19fb94f',
                    '0xef51c8cbda0bc10830026f9f972d998f049bfb8f',
                    '0x0fb08fa6c0acf56e6b0f8f14ff85c65eb32b2cfd',
                    '0x0742015f463b1e0a9e741b4e72e80cf3242a34ee',
                    '0x86b337be60c942e80f31e7be097de1ca821c5f7f',
                    '0x18525ddc9d8b8a8d9f07e6b31bb13f4dcf0363ab',
                    '0x1aade1adaad62a7f98349bb8d2cb1512fac02ef6',
                    '0x1b9266b99b08f52f7c2af69146359913f3f18fc3',
                    '0xdf2720693c4f239d0627224acb91cb788452c6ef',
                    '0x3069b44b05085425a42a52151e037823d180b589',
                    '0x182049c1a42ceeb429f9308ca8e7629bca08a0db',
                    '0x186a9879c03ae99ca2e693c561fff695c5aa01b8',
                    '0x0df26c70dca35e0da91b643c85a3e07abc8580e6',
                    '0xc50a06c9d33cdcf442a38eb4dad3ebda4e228099',
                    '0x275171125698227a821dbbeaefaf4a4a31679dd5',
                    '0x2b9087ff9803b969368fa57f48d67e5dd499d25c',
                    '0x2bb6fef629db2e1dd7529090f1befd03cbc97610',
                    '0x2b942bbe7c3615f7edb87dfb5810c5e4208da5d8',
                    '0x056352f76ecd9ee13d6c0e69413a70509a9b5e52',
                    '0x6e8d38255028a79eff822d7bd49381d16cae9db1',
                    '0xef5c8059f92e875bee7e2b3ee25e3e7b9f788c00',
                    '0x9c2a488f3342b259b787eb9ed658c27d1bc00833',
                    '0x3fce7505a67dcfcb7a0da930e2f9c1cdaa37b7ec',
                    '0x1684b945e80e3c87a405f3beb29d11879aed2980',
                    '0x4042435a87073cb7cf1c6c4ea417620fee780edf',
                    '0x40899148314db866599cbc08717d81b06e89bcfd',
                    '0x40f05f3321575af118597c02489f6119d04bebdc',
                    '0x410947db72e3eafa63f45d93e01c77913fd6ea45',
                    '0x4116d832760c257ceefd35f9867f44f88f23e5fe',
                    '0x414de6e29bfb7d4a857df6d94381b326eb80a36b',
                    '0x41f9d20262a197a954e903ac5ea77f745cbb66b5',
                    '0x42382be640f848ff44cc0770e7f08c122c4ab0a1',
                    '0x261fc32d628a6e1da065cae94521d4280220ac35',
                    '0x42709d50d3c6c66563bff58b7eecb42814eee7b7',
                    '0x429ff496d861c8ba1fa49b57b974f6549b52771e',
                    '0x42ae9b154a443c74091a658c904c263d7da8aec3',
                    '0x42fda372238d68e8ca6f6018962f7d05d288c0a0',
                    '0x44c739826be3e61ae978ba555d5d80321d672d0d',
                    '0x535bcb4dbfb8ffa1d33f16f361555f714a8ebdb9',
                    '0x53873894bf4ef57ac3284c4180d9ac468ed43486',
                    '0x538a9b0edd2d4ea93ffb9753ddd78036d0482706',
                    '0x53e44ea6d739776b628b4f73ebd288cc5477a458',
                    '0x5433ffb0892be474e605361932c26697749fcc9a',
                    '0x56ff710fec18c9d1f2b539f9f68e157170584904',
                    '0x4911d69c6b7e2c2df83e1d377b716b954971c872',
                    '0x2843f4f6f09566aba98c59dca7a41346178e3e5f',
                    '0xe5f36c26b0c0f83f9c6cd8196e43a370103367da',
                    '0x5ae5edb7c8cd5141609621644d522961d056bec9',
                    '0xd179c0485244fc1414053a8ded8bef50e0ff4be4',
                    '0x297e08f4a537d8fa2c4827578ed3ea5f470201d6',
                    '0x5c8680dce97932edf4a14184ce8188ecbfba591f',
                    '0xd045597ec184d475f26b25c5b24ef0db1eb9694e',
                    '0x73890b6645db534b034852ab49c3aa6c4eab2d5a',
                    '0x8ccb4fee9938b91d3f723d66e71948ee08cdd0cd',
                    '0x88fc58064cd2a189be870e9c15684f29518648b7',
                    '0xb05d6fd3ac3383da24c850aaa25b7898bc5f2b5a',
                    '0x499f4f3d4de26e4bc416337b88c352d2bf6160cd',
                    '0xf647c936fa9064b67e59c962b069626cb688ffb1',
                    '0xdbfba33429821ce38bd5338f1e555bb5732ef24e',
                    '0xae6f759736c2ae51984fb2439c20f0db216ca872',
                    '0x279b50371b3c936e1dea84ad1e9372e79e74dcc2',
                    '0xd288187e2fa246f0e485e5bfef43ff3f02eeeba4',
                    '0x0002442b76ad1b7e9c2659a761e5706c4fde7e80',
                    '0x75bfbc0765f9b154a8b2c1a9d4914ea01dfd4965',
                    '0xcb05ddf09a71162970be6fac7b82e52cf1097cff',
                    '0x9a6dffb91d69bb23cf3b1862298540ace0eb3dc1',
                    '0x07ddf1a092d7e5099747b0d429406f11bfdc5a49',
                    '0x23fe4f3595823d23f6a20bf992ac59a5b21ea22b',
                    '0x300e8a7f64be5a9cfb9e92749def8111b856a7ec',
                    '0x741bf2643326e094c2a143ff2a31c9f7ddc90cfb',
                    '0x74db702b80abbc728c6c8db4bec8d4e18e1c61c7',
                    '0x08bb7b7f7cbe2b06a0251e5954af2204862a02ae',
                    '0xd818011b4baf580f1585e518a2eae5e147915c90',
                    '0xe9442731e5c6db811b2efaef1e0d9abe62bf30db',
                    '0x4bf01ce1b2fa14848cd0440cee44e484da5ce64a',
                    '0xe4220b128d7180e656f24c080d5b20172710ec6e',
                    '0x20ff7e19c8ff23109eb1661df3b3c4f36ddadf1f',
                    '0x82d313f325b3c9b63502bffe9c01361037086e99',
                    '0x4b9c798ef1dbcb76aa44c695977e4f5fa460897a',
                    '0x3d0161853f2f9aa888dfd56f3e97f1234f902d66',
                    '0xb80c61fd9b4df38500aa99df9d7b2570866577ce',
                    '0xd10629e28186826e36f72d7443bd254cc76721eb',
                    '0xd7b79b3885cc8a5bd7e5c8c7fb5b73f17d8e1242',
                    '0x3c7d0826b80138e733b32950e193e2a836da112c',
                    '0xccaba0ddf58daeaf194b449a52e4a569f5c7d071',
                    '0xd02181f382e0bf9eeeaf54a1a954cf16e0706e8f',
                    '0x123456f07ed6950ba2aa2f8314fba0c8f8690296',
                    '0x860740c55e4b623d16eca501b2edffa7512fbfca',
                    '0x4f0ab8ad12b841d552b03482d040d7d4e42b031a',
                    '0x85304fbc102e22a0308e027174c89379b54fcd95',
                    '0x7387386b3de77943272b2b47297a6cb7a6d0e54d',
                    '0x8fd27224c56e9932638c257e50a6e7d7347291cc',
                    '0x4f7093b1628a7aec077ce820634cd4506827d95a',
                    '0xfe4fb89bd1e97078ead0be71ccd4531d2f3f5dc8',
                    '0x28d9445c0422a87f2456e73c669237a136d7b7f5',
                    '0xfb5c43f8f5091ea1aca8366885f00c6cdcad64eb',
                    '0xeb88a76f346e68533f45df8c86ba11ab2d74ba3c',
                    '0x89bf5e78ba03cee799e0202f7cbd5160b8c615f0',
                    '0x22c032d041a70150134aa350b595afe162afb993',
                    '0x2d0f146307c029a4faf739fe6973b4d15810ff58',
                    '0x4f4420986e80f867a194ac0da6ee994aabc993fd',
                    '0xde5ee2fac13c1c09222db6784b732054b9a8bac3',
                    '0xe8d49afaa84ebe319ff086afc181dc11713bf75f',
                    '0xa7b1e6ce90d7bfe51170fefecc9bf4a7dd1ed071',
                    '0xa1eed1566f5ec6c1b3985b6fc9f101a68fdb7071',
                    '0x4650d0c9e3148a8f66af374820aa2eca0a47dad4',
                    '0x3a8ff7ced849611e59a23c2ebf1664254292ae70',
                    '0x68230f64c9258ad9cd911ee1eadbb345047bd935',
                    '0x7dd4b7c7d60ec09d77f504d4e5eaa8355f65dc75',
                    '0xd9975661da23c18a37d2d14c2a379ca8598c55e6',
                    '0x20413792ca7ec69958b535af3b00d4ac422d8771',
                    '0x8976756e7f7e0fe78edd829ad9e3f812039fc982',
                    '0x415be58b62ed85ea515137ac6aaf03702e7e4040',
                    '0x0ae100c4c3c95e358b0dd299fc5c8d09ee5098be',
                    '0x911edbe1f92cc67f7baba6d38381ba16e76ff7df',
                    '0xb7000000000000787482973d46d105ac3ce851ed',
                    '0x307c29ce1aeb55313257aa8202be2e7c3d34da0f',
                    '0x236c31ccc1aaf26f977c14c6fda9336135847b74',
                    '0x24b3e9984eb93c207be67be0b632a24f07a0703f',
                    '0xeda698031d3e07f31a4d90e000732b0eac73e95c',
                    '0x558cef368bb8608ac179adf563875635378b3b7e',
                    '0xe4b97c4d861ddc060397a6b3241c94b5564c926c',
                    '0xd2d187235a5df5a614ffbec5219aee2c9b8d4b64',
                    '0x4c0560af52243bd4bf11e1e21136fcf1fbe4df13',
                    '0x69caa06515df8052f174d919db888835f5c4eebb',
                    '0x2745645233a6259df5063ee18b6907ea54694d5a',
                    '0x2193927b8840d1e06aff626359fe5d67d865c88f',
                    '0xd80b6996c73ba77ff96ff2ada982eba1cb73d387',
                    '0xbf4e6affa7fe319c62a6ffec49ac73b3164798d2',
                    '0x210b38ebcb993888224e241d0dab92be7c46d6f1',
                    '0x70b557c8a526676eabe67d2955ff325c3e5a52e7',
                    '0x242c1bf4b5d8ce15f41dcfb16cb88e61a4d8b66c',
                    '0x22370858e79c7b71123b5214d3bcdf6bb4e1e2f3',
                    '0xc34540298ff490aad75a3cb89a6d1ccf16d3ef5b',
                    '0xb9c1412b32ed5792c57e54798e04292115ab9818',
                    '0x3fb436dd0c0738aa8e715a6766bccb65629d428b',
                    '0xa64b648a1c35446ef2e318b58c5fbb0f5cd199a3',
                    '0xe6469266c7f3e5dfb629fb316aaf33eb18dc92c8',
                    '0x33665988b084e1032214c2f3a1d7fbf161dcaeea',
                    '0x6366da3153c5b21e37b702a0c114bdf7d32ce1fd',
                    '0x69b53d2c6e208121a63ce741e2ae95cff34b050e',
                    '0xaff3d8bbde3b450598d2b1c6e4620dbe805ffe6a',
                    '0x24245a07a60f325c57088f9c488887519bad9ace',
                    '0x2a6fa6f5539c54cc0ca887802675b2a8813d4eb6',
                    '0x58f3f0e0f51e4d95d61fd3e8ec5a430393b1e5ac',
                    '0xf401ff8195b95cea90ba649e506e5a9dfefce055',
                    '0x4b1a2ee5e367c1f8ea5f68ab66288a8e8d157860',
                    '0x3e32c70b82f79dd243dcd32ae9231c2c19f5ae23',
                    '0xa5f82b9398065abb2e78e12e0377d33d12baf882'
                ]
            ], [
                'name' => 'CoinEx Shirt',
                'count' => 50,
                'limitPerAccount' => 50,
                'holders' => [
                    '0xAe172E461207dEf62D532583F41c1712d7C9FB19'
                ]
            ], [
                'name' => 'MetaGaming Guild Shirt',
                'count' => 50,
                'limitPerAccount' => 50,
                'holders' => []
            ], [
                'name' => 'Ownly Shirt',
                'count' => 50,
                'limitPerAccount' => 50,
                'holders' => []
            ], [
                'name' => 'Senioritos Shirt',
                'count' => 50,
                'limitPerAccount' => 50,
                'holders' => []
            ], [
                'name' => 'SparkPoint Shirt 1',
                'count' => 10,
                'limitPerAccount' => 10,
                'holders' => []
            ], [
                'name' => 'SparkPoint Shirt 2',
                'count' => 10,
                'limitPerAccount' => 10,
                'holders' => []
            ], [
                'name' => 'SparkPoint Shirt 3',
                'count' => 10,
                'limitPerAccount' => 10,
                'holders' => []
            ], [
                'name' => 'SparkPoint Shirt 4',
                'count' => 10,
                'limitPerAccount' => 10,
                'holders' => []
            ], [
                'name' => 'SparkPoint Shirt 5',
                'count' => 10,
                'limitPerAccount' => 10,
                'holders' => []
            ], [
                'name' => 'Team Manila Shirt',
                'count' => 50,
                'limitPerAccount' => 10,
                'holders' => []
            ], [
                'name' => 'Bicol Blockchain Conference 2022 Shirt',
                'count' => 20,
                'limitPerAccount' => 2,
                'holders' => []
            ], [
                'name' => 'Philippine Web3 Festival Turtleneck',
                'count' => 50,
                'limitPerAccount' => 2,
                'holders' => []
            ], [
                'name' => 'DivinaLaw Shirt',
                'count' => 50,
                'limitPerAccount' => 10,
                'holders' => []
            ], [
                'name' => 'Meatspace Shirt',
                'count' => 50,
                'limitPerAccount' => 10,
                'holders' => []
            ]
        ];
    }

    public function storeMinter(Request $request) {
        $request->validate([
            'type' => 'required|in:web3fest',
            'address' => 'required|min:42|max:42',
        ]);

        $mustachioRascalMinter = MustachioRascalMinter::where('type', 'LIKE', $request->type)
            ->where('address', 'LIKE', $request->address)
            ->first();

        if(!$mustachioRascalMinter) {
            $mustachioRascalMinter = new MustachioRascalMinter();
            $mustachioRascalMinter->type = $request->type;
            $mustachioRascalMinter->address = $request->address;
            $mustachioRascalMinter->save();
        }
    }

    public function downloadFBX($id) {
        $mustachioRascal = MustachioRascal::find($id + 1);

        $uuid = explode('https://ownly.io/nft/mustachiorascals/gif/', $mustachioRascal->image);
        $uuid = explode('.gif', $uuid[1]);
        $model = 'https://ownlyio.sgp1.digitaloceanspaces.com/ownly/mustachiorascals/fbx/' . $uuid[0] . '.fbx';

        $filename = 'temp.fbx';
        $temp = tempnam(sys_get_temp_dir(), $filename);
        copy($model, $temp);

        return response()->download($temp, 'mustachio-rascal-' . $id . '.fbx');
    }
}
