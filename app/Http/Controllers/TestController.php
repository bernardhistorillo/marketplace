<?php

namespace App\Http\Controllers;

use App\AmacRegistrants;
use App\Collection;
use App\Mail\AmacCertificate;
use App\Mail\AmacTicket;
use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TestController extends Controller
{
    public function try(Request $request) {
//        // Removing duplicated addresses
//        $temp = [
//            '0x9E61c42166E32C257E8F154bE061645F975925d6',
//            '0x63a71444d6cB077Fd9Ad1CdDb852C587BB3F1fc5',
//            '0xE27851Aaea36A0E3940a059bcd7Ce083Fbe6c307',
//        ];
//
//        $new = [];
//        $string = "";
//        foreach($temp as $i) {
//            if(!in_array(strtolower($i), $new)) {
//                $new[] = strtolower($i);
//                $string .= "'" . strtolower($i) . "',<br>";
//            }
//        }
//        return $string;

//        $withCustomShirts = [
//            124,125,126,127,128,129,130,131,132,133,
//            26,70,187,188,191,192,193
//        ];
//
//        $names = [];
//        foreach($withCustomShirts as $withCustomShirt) {
//            $response = Http::get('https://ownly.market/api/rascals/' . $withCustomShirt);
//            $names[] = $response['name'];
//        }
//
//        return $names;

//        $amacRegistrants = AmacRegistrants::where('is_validated', '>', 0)
//            ->get();
//
//        foreach($amacRegistrants as $i => $amacRegistrant) {
//            $amacRegistrant['id'] = $i;
//            Mail::to($amacRegistrant['email'])->send(new AmacCertificate($amacRegistrant));
//        }
//
//        $amacRegistrant = AmacRegistrants::where('is_validated', '>', 0)
//            ->first();
//        $amacRegistrant['id'] = 0;
//
//        Mail::to('bernardhistorillo1@gmail.com')->send(new AmacCertificate($amacRegistrant));
//
//        return view('emails.amacphCertificate', compact('amacRegistrant'));

//        $contractAddress = 'boydibil';
//
//        $collection = Collection::where('url_placeholder', $contractAddress)
//            ->first();
//
//        $tokens = Token::select('collection_id', 'tokens.id', 'tokens.token_id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'supply')
//            ->where('collection_id', $collection->id)
//            ->leftJoin('token_transfers', 'token_transfer_id', 'token_transfers.id')
//            ->orderBy('tokens.id', 'asc')
//            ->get();
//
//        $owners = [];
//
//        $tokens = ["0x66E7c903C4613643B70FdB1d8ae08F265037F2A1",
//            "0x7948B2c1b2AAF91452f4Af0B8Ad0C60443bf849a",
//            "0xF3309975C3Ab758E8b3937f5C524002EB09AB5eB",
//            "0x5c472CEC3a81aC1F524c9d5229B9FFdAfaaF97a3",
//            "0x71f09fc35a096b48d830Dc775B942E613bd575E3",
//            "0x729C13aF545a476a2139FB61C5f3b1e554d38D98",
//            "0x39010A5117b7401B78ca5F149Af2DC320ACF5EC9",
//            "0xB831C4b3fEaCD327E3E16CC6330061B86A693Cb7",
//            "0x265Dd3fcFDDfe2cb7c609501A6a5CE37e5c25EE9",
//            "0x72C3346FD437FFd310Da17e6BbdF2488552d0fc7",
//            "0xf2C0499E209acd8FfF122f5B4E93E54C2e0b0ECA",
//            "0xd3f3C170127A3ec454faB3d74bb4062aaF3688C4",
//            "0x4310e19E1195c77830069Bb69e3954752C868030",
//            "0x3cc9d616fff34f1cfe097884038d531086d94729",
//            "0x7ef49272bb9edbf9350b2d884c4ac0af34d9826f",
//            "0x3a21d4a9bb2ac5c5071f82c1d3a84be36ae5d3f0",
//            "0xb132f2c06a4079d546d4914a61e5c1be65787fd6",
//            "0x310b0be6cd6316c3e4e878ab97655e74ee28d595",
//            "0x5266230f6d0c412bbb7939c0f6b530cac33b703a",
//            "0xafaafd2149c240ee62e9bb879e98847ef5f27187",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x5f2a89124b8bf0964eede4339d564d107df74eba",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x37e79fd795c8602e2bba6ef2507ae34722122396",
//            "0xd5f11a730c63c1cc8d6371d9f5682532828fd4aa",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0xcd7d67add8d8c1d8cd2e945891e6479e61749b23",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0xe53ea28389143dbc561d17c8272a6c137116bd03",
//            "0xeafd76f0af95279b96f846ae4891ce7abc9a2314",
//            "0x0f255aaf6b5131ea0fe46970fd93bed3314080f2",
//            "0x1865d010ade00991b1a244e78efa81766bddabde",
//            "0x1865d010ade00991b1a244e78efa81766bddabde",
//            "0x981bb04ebd45a1e41585b54e19c9477e7fcb9f2e",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0xe53ea28389143dbc561d17c8272a6c137116bd03",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0xc1cf6da120b174df84203ec2aa89d05a7430f566",
//            "0x6016c4418a3e0bd8987b481201841a3346efd15c",
//            "0x1b44780c6510ba08b43c4f5df4edc77df5f033d9",
//            "0x645e8537a6252aac5beb1cede014e6b21894242f",
//            "0x2277bfa158d03e5633872bd392e5884439c9c821",
//            "0x33babc18c3ef3d4e23c0727ce6e811ff7b6410c2",
//            "0x6c15d3a7ea840a8cb2884056233b8aef8e6e269c",
//            "0x16ede6a334f7e96a567489864ec684878c8bdeec",
//            "0x2d616a0d7104d5e837801dd25b50ba2246dcce2e",
//            "0x5f2a89124b8bf0964eede4339d564d107df74eba",
//            "0xcf2b7c6bc98bfe0d6138a25a3b6162b51f75e05d",
//            "0xd6d46e59fd522d20d666f8042bef997fd68c1641",
//            "0xff56c664f935a9740de216452d9a7878ae6db969",
//            "0x2fcd91c3bce0399cf01ddd83f3478a900ccbd72d",
//            "0x5e78b20d6ba0bb7379259cc1b7909e444dcb6e35",
//            "0x8318582d24d28a81ea27a570ac0851f39ef20b58",
//            "0x99d56ed76d4eef653a57948335351387b038503a",
//            "0xa8f4af44f6c28fe21eb949938acf7d42148ac3c0",
//            "0xc04f311382aca5dedde1a17176ba52ee853b6ea5",
//            "0xfeca6e9a0706eec0dcd96fd63b4a6b72f78756e1",
//            "0xd3f3C170127A3ec454faB3d74bb4062aaF3688C4",
//            "0x3cc9d616fff34f1cfe097884038d531086d94729",
//            "0x7ef49272bb9edbf9350b2d884c4ac0af34d9826f",
//            "0x3a21d4a9bb2ac5c5071f82c1d3a84be36ae5d3f0",
//            "0xb132f2c06a4079d546d4914a61e5c1be65787fd6",
//            "0x310b0be6cd6316c3e4e878ab97655e74ee28d595",
//            "0x5266230f6d0c412bbb7939c0f6b530cac33b703a",
//            "0xafaafd2149c240ee62e9bb879e98847ef5f27187",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x5f2a89124b8bf0964eede4339d564d107df74eba",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x37e79fd795c8602e2bba6ef2507ae34722122396",
//            "0xd5f11a730c63c1cc8d6371d9f5682532828fd4aa",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0xcd7d67add8d8c1d8cd2e945891e6479e61749b23",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0xe53ea28389143dbc561d17c8272a6c137116bd03",
//            "0xeafd76f0af95279b96f846ae4891ce7abc9a2314",
//            "0x0f255aaf6b5131ea0fe46970fd93bed3314080f2",
//            "0x1865d010ade00991b1a244e78efa81766bddabde",
//            "0x1865d010ade00991b1a244e78efa81766bddabde",
//            "0x981bb04ebd45a1e41585b54e19c9477e7fcb9f2e",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0xe53ea28389143dbc561d17c8272a6c137116bd03",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0xc1cf6da120b174df84203ec2aa89d05a7430f566",
//            "0x6016c4418a3e0bd8987b481201841a3346efd15c",
//            "0x1b44780c6510ba08b43c4f5df4edc77df5f033d9",
//            "0x645e8537a6252aac5beb1cede014e6b21894242f",
//            "0x2277bfa158d03e5633872bd392e5884439c9c821",
//            "0x33babc18c3ef3d4e23c0727ce6e811ff7b6410c2",
//            "0x6c15d3a7ea840a8cb2884056233b8aef8e6e269c",
//            "0x16ede6a334f7e96a567489864ec684878c8bdeec",
//            "0x2d616a0d7104d5e837801dd25b50ba2246dcce2e",
//            "0x5f2a89124b8bf0964eede4339d564d107df74eba",
//            "0xcf2b7c6bc98bfe0d6138a25a3b6162b51f75e05d",
//            "0xd6d46e59fd522d20d666f8042bef997fd68c1641",
//            "0xff56c664f935a9740de216452d9a7878ae6db969",
//            "0x2fcd91c3bce0399cf01ddd83f3478a900ccbd72d",
//            "0x5e78b20d6ba0bb7379259cc1b7909e444dcb6e35",
//            "0x8318582d24d28a81ea27a570ac0851f39ef20b58",
//            "0x99d56ed76d4eef653a57948335351387b038503a",
//            "0xa8f4af44f6c28fe21eb949938acf7d42148ac3c0",
//            "0xc04f311382aca5dedde1a17176ba52ee853b6ea5",
//            "0xfeca6e9a0706eec0dcd96fd63b4a6b72f78756e1",
//            "0xd3f3C170127A3ec454faB3d74bb4062aaF3688C4",
//            "0x3cc9d616fff34f1cfe097884038d531086d94729",
//            "0x7ef49272bb9edbf9350b2d884c4ac0af34d9826f",
//            "0x3a21d4a9bb2ac5c5071f82c1d3a84be36ae5d3f0",
//            "0xb132f2c06a4079d546d4914a61e5c1be65787fd6",
//            "0x310b0be6cd6316c3e4e878ab97655e74ee28d595",
//            "0x5266230f6d0c412bbb7939c0f6b530cac33b703a",
//            "0xafaafd2149c240ee62e9bb879e98847ef5f27187",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x5f2a89124b8bf0964eede4339d564d107df74eba",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x37e79fd795c8602e2bba6ef2507ae34722122396",
//            "0xd5f11a730c63c1cc8d6371d9f5682532828fd4aa",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0xcd7d67add8d8c1d8cd2e945891e6479e61749b23",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0x8737ae65c6f2c14f67ef4e7371fe5be594b776b8",
//            "0xe53ea28389143dbc561d17c8272a6c137116bd03",
//            "0xeafd76f0af95279b96f846ae4891ce7abc9a2314",
//            "0x0f255aaf6b5131ea0fe46970fd93bed3314080f2",
//            "0x1865d010ade00991b1a244e78efa81766bddabde",
//            "0x1865d010ade00991b1a244e78efa81766bddabde",
//            "0x981bb04ebd45a1e41585b54e19c9477e7fcb9f2e",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0xe53ea28389143dbc561d17c8272a6c137116bd03",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x1e508adb6cbe9c76b4b6c7052852874022a7aa89",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0xc1cf6da120b174df84203ec2aa89d05a7430f566",
//            "0x6016c4418a3e0bd8987b481201841a3346efd15c",
//            "0x1b44780c6510ba08b43c4f5df4edc77df5f033d9",
//            "0x645e8537a6252aac5beb1cede014e6b21894242f",
//            "0x2277bfa158d03e5633872bd392e5884439c9c821",
//            "0x33babc18c3ef3d4e23c0727ce6e811ff7b6410c2",
//            "0x6c15d3a7ea840a8cb2884056233b8aef8e6e269c",
//            "0x16ede6a334f7e96a567489864ec684878c8bdeec",
//            "0x2d616a0d7104d5e837801dd25b50ba2246dcce2e",
//            "0x5f2a89124b8bf0964eede4339d564d107df74eba",
//            "0xcf2b7c6bc98bfe0d6138a25a3b6162b51f75e05d",
//            "0xd6d46e59fd522d20d666f8042bef997fd68c1641",
//            "0xff56c664f935a9740de216452d9a7878ae6db969",
//            "0x2fcd91c3bce0399cf01ddd83f3478a900ccbd72d",
//            "0x5e78b20d6ba0bb7379259cc1b7909e444dcb6e35",
//            "0x8318582d24d28a81ea27a570ac0851f39ef20b58",
//            "0x99d56ed76d4eef653a57948335351387b038503a",
//            "0xa8f4af44f6c28fe21eb949938acf7d42148ac3c0",
//            "0xc04f311382aca5dedde1a17176ba52ee853b6ea5",
//            "0xfeca6e9a0706eec0dcd96fd63b4a6b72f78756e1",
//            "0xd3f3C170127A3ec454faB3d74bb4062aaF3688C4",
//            "0xc8c6407eef993bb1e11f3756d2b2e1411b5073a0",
//            "0x77270036e2498ecae1baf522ae257f2ec4856dbd",
//            "0xd5272277ceec9963b3f95a07da11508fbc06589d",
//            "0xc606e5e6e95e8b5fe7b09b3ec3012ee77d083a76",
//            "0x724ee62b95a70afcc5f3e1e1430b5727136f79b3",
//            "0x596e53072d5e4072b862a70fae204c520b889b45",
//            "0x645e8537a6252aac5beb1cede014e6b21894242f",
//            "0xa8f4af44f6c28fe21eb949938acf7d42148ac3c0",
//            "0x5e78b20d6ba0bb7379259cc1b7909e444dcb6e35",
//            "0x2fcd91c3bce0399cf01ddd83f3478a900ccbd72d",
//            "0x938ca3ac806f8515a600c8c25680de3c24db0d91",
//            "0xa34deea4c1b01a5d76b35bf68f9758512a5c5444",
//            "0x11387fadef34ed0152e33967a4178213f3a7dda1",
//            "0xfe4e3fad35c820681dfb13f93188cd822f9445ac",
//            "0xe94d448083dfd5feafb629ff1d546ae2bd189783",
//            "0x20ac04264d6251ebb6b240fcdc397ba2f48f8344",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0xbe775e3ab0ff7b38fb3523cddb4ead4056864b22",
//            "0xc790837b092392856a31e117fdf045e0448c16b4",
//            "0x869adf6e6ec1ef32f9458595ef0be27ddfcaed43",
//            "0xd08329a3b20fcd160381ba9a3f8c44a91a20863b",
//            "0x89a851640da7a97af8061c2192e589d3836f843f",
//            "0xda2a6c44f1dc7bdb58e867ad26b8158235252651",
//            "0x99d56ed76d4eef653a57948335351387b038503a",
//            "0x50ccb88bc1c22cd9c7793319671bec4c0fd63701",
//            "0x01fb2268ad110cf1302fa51b2e4ea737e68da920",
//            "0x08b296a897b1c8a033066a34dfde80c66a825d7b",
//            "0xb8effe4cd13b9b269aba6be8920fd235a555bca2",
//            "0xcf2b7c6bc98bfe0d6138a25a3b6162b51f75e05d",
//            "0x60af0d6924fe371ec52e2ebcf572f5636a1ddbee",
//            "0x47ee37749c1ff103825a60f72063d7db6e80fdfe",
//            "0x7688aa7e4b0c74e57dd7aaf115cc869d6eb50062",
//            "0x362f7b9e49d2fffab29c2cd294ef152c087b0259",
//            "0xe9f81b17393dca96384a79dfa1c3e5b3d8e4efeb",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0x9eb299bf7d5a24b84b8b906cf4b577d8b44f856d",
//            "0xc4a6e0572e1827cac79d09c87e211bda3cbb2c91",
//            "0x434f4a60be4462148e989a404079de95d12b521e",
//            "0x65469a15cf37c67871bec12547c0117c8f317d0a",
//            "0xf23261df1e5b901e075ed86973679b4811858355",
//            "0x07c7d8f1862175721a730fc97ae87fd1914f00c5",
//            "0x686065227b7f881991eca1f4b9b016a43fccb429",
//            "0xe911f8cf79a419fccbc55a38f90e0559ba6db943",
//            "0xb6a7510786abddbb2d12af4a380a3f41191f8fa2",
//            "0x3810621dcff8b0f8720af5dfac7c09364afac9c2",
//            "0xde99bd5c31b867e77cc037f55f5a11b657cdb838",
//            "0x0182a7cca7e119db5feccc12f5c9a9ee4359a7ef",
//            "0xe61123c4e2540ce911fc6aa7207d3310f8e1103b",
//            "0x6d81c457fabc8c639d6b79c2038478e6ea74a29a",
//            "0x5c8ec17e127435e42a37ec0890424e17a8ca45a7",
//            "0x8671f5a1b7712bf98d2c2d7df6819b1c9841626c",
//            "0xb65e94b74d19c84d37d38688dec741478924cac8",
//            "0xa37c03a05f0755155258e6552b571a6b8ecfa59a",
//            "0x0dfd291187105207ebbc803e236a097810291f54",
//            "0xd14c81c7423584bb65f8692c34b015854bf4eb75",
//            "0xe061d255d9fb5db082e3e04e6aa72409cb6f298b",
//            "0xe2693e68efea76424c0d8e9b6456bd797e486755",
//            "0xafaafd2149c240ee62e9bb879e98847ef5f27187",
//            "0x1796a22a04c43a8e54c88a31fb4d96fc67394ea4",
//            "0xa65ae8f0c20ad41f93c9bb2381fe079cae3f59b5",
//            "0xf6fd1a45c9acd4b0484350a3b38088cb20c5ba02",
//            "0x9c28bf1fdeffadcbf31a68476832097b017e2df2",
//            "0xe6d2342572d8ad0fc4fa7ed3197114131020801d",
//            "0xb91222acab64a323b62800fcc21ca6c187e1af3b",
//            "0xc6fe07f7f655ba1642f3e593e1cd584fe563d4ac",
//            "0xf283f4fff884c70df8f731321ba76ec665f22ee7",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0xb5a58ac6cce6d8a9278ed984d9b8c47cc227d2cf",
//            "0x223dfeca96a09793672add4b35ea7d40ece183f5",
//            "0xf283f4fff884c70df8f731321ba76ec665f22ee7",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0x13221e1e738924aaf5cc1b2da801598479e06f6a",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0x8976756e7f7e0fe78edd829ad9e3f812039fc982",
//            "0xde5332b5635bf4cb6a22ced0c8402143e60fe130",
//            "0x8b8749c635c5caef3a691c042dfa5b25ce94231b",
//            "0x9faea8c0f0a9682f4a130bae44cfbfd1ee03b6b0",
//            "0xd5f11a730c63c1cc8d6371d9f5682532828fd4aa",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0x1ffc45567c7b8720486a140637f0828280bc90d6",
//            "0xd5272277ceec9963b3f95a07da11508fbc06589d",
//            "0x24ddb6bf9ccfcc79a781de5c9aaf7c0ed63bb869",
//            "0x66dfbf78c4fbef76dac2f6dd263a66879b353da3",
//            "0xa7c5f19646fa4bc36a177d42175061a99896acf1",
//            "0xa5c3664578b8bbe73320af06fa1b2cedd208fe59",
//            "0xbf4d9b2fe9d602451bdf5523f4c697e0a1e5fe3c",
//            "0x26ed4f7a8459e221908af3c9fa3b0707185293cb",
//            "0x8318582d24d28a81ea27a570ac0851f39ef20b58",
//            "0xe94d448083dfd5feafb629ff1d546ae2bd189783",
//            "0x5606984300ce3c8d15decc31de0fc3ac1cb45500",
//            "0x7c813f7e764df2f10ab2b1800eba4353bc1553a7",
//            "0xcd7d67add8d8c1d8cd2e945891e6479e61749b23",
//            "0xf6fd1a45c9acd4b0484350a3b38088cb20c5ba02",
//            "0x24ddb6bf9ccfcc79a781de5c9aaf7c0ed63bb869",
//            "0x24ddb6bf9ccfcc79a781de5c9aaf7c0ed63bb869",
//            "0x24ddb6bf9ccfcc79a781de5c9aaf7c0ed63bb869",
//            "0x20ac04264d6251ebb6b240fcdc397ba2f48f8344",
//            "0xa1aae46d0758e701f909141b22e396d3315b5250",
//            "0x36b509e5235e2415625d9a641c06e8930f742a66",
//            "0xe2693e68efea76424c0d8e9b6456bd797e486755",
//            "0x8507764eea4ca891a49825b58a1db07a611a2035",
//            "0xddad2479cfe9e29f1b2866c73c12c1a108413483",
//            "0x45efcff5899d5a0b2053c7fccd51110bbf54437c",
//            "0x36b509e5235e2415625d9a641c06e8930f742a66",
//            "0x36b509e5235e2415625d9a641c06e8930f742a66",
//            "0x2bacda743d10170034705c6cc8e54f24635afcb6",
//            "0x223dfeca96a09793672add4b35ea7d40ece183f5",
//            "0x6546767208a0604f7d3d06ac549cab874a41d4d9",
//            "0xe5eacd6c4f7f7e83a8e92a801f07d4bb347149fe",
//            "0xde722c0d8738a1e0ec7885483331f52fb3b7f308",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0x101fbec10057edf6ee7a84099c0765ac3c8b4d40",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0x3cc9d616fff34f1cfe097884038d531086d94729",
//            "0xe0b037b35a5dbc6277266d55d917e4250a2aa9a6",
//            "0x8177598e08ee8199c160a48c7a0af31ab54bb59f",
//            "0xe1ff19610020d72930aee1b9c047e35b7fd0080e",
//            "0x8177598e08ee8199c160a48c7a0af31ab54bb59f",
//            "0x9c5142ca89eac453c1eb9ef8d5e854ca01743f6e",
//            "0x2a3d75bf95f6ca98d63b66e7490d2045e110a8ed",
//            "0x9c5142ca89eac453c1eb9ef8d5e854ca01743f6e",
//            "0xe1ff19610020d72930aee1b9c047e35b7fd0080e",
//            "0x23f562a7d671fb41ef3fbec4a0e982bfcfe8f285",
//            "0x4c41f7201552487a55c623f8a45694d9f88c2b81",
//            "0x1ea948c321e4d96a7b358ef0fe3cfc51d7db6424",
//            "0x42e16d567e3b138e539a36e81071231790512ec5",
//            "0xb6151dcd76563244711af9469c1ae7f1a2e06231",
//            "0x1ea948c321e4d96a7b358ef0fe3cfc51d7db6424",
//            "0x09d520c793dd698bd910984adb4c4718bb20beda",
//            "0xd58d40fe101cf288d585b6134009740b1877fe8a",
//            "0x1ea948c321e4d96a7b358ef0fe3cfc51d7db6424",
//            "0xd52ec343dd85c891ed12c5af72643ac115a953f8",
//            "0xe2693e68efea76424c0d8e9b6456bd797e486755",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0xe2693e68efea76424c0d8e9b6456bd797e486755",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0xb1d9578cfd5211a795926e795530cc3c0517cc7f",
//            "0x768532c218f4f4e6E4960ceeA7F5a7A947a1dd61",
//            "0x88A14AF453b14070B9B943eea32bf3F534dFa01a"];
//
//        $new = [];
//        foreach($tokens as $token) {
//            if(!isset($new[$token])) {
//                $new[$token] = 1;
//            } else {
//                $new[$token] += 1;
//            }
//        }
//
////        return $new;
//
//        $return = [];
//        foreach($new as $i => $new1) {
//            $return[] = $new1;
//        }
//
//        return $return;

//        $amacRegistrants = AmacRegistrants::where('is_validated', '!=', 0)
//            ->get();
//
//        foreach($amacRegistrants as $amacRegistrant) {
//            Mail::to($amacRegistrant['email'])->send(new AmacTicket($amacRegistrant));
//        }
//
//        $amacRegistrant = AmacRegistrants::where('is_validated', '!=', 0)
//            ->first();
//
//        Mail::to('bernardhistorillo1@gmail.com')->send(new AmacTicket($amacRegistrant));
//
//        return view('emails.amacphTicket', compact('amacRegistrant'));

//        $response = Http::post('http://ownly.market:8080/web3/getTokenOwner', [
//            'rpcUrl' => 'https://bsc-dataseed.binance.org/',
//            'abi' => '[
//    {
//        "type": "constructor",
//        "inputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "Approval",
//        "type": "event",
//        "inputs": [
//            {
//                "name": "owner",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            },
//            {
//                "name": "approved",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            },
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "indexed": true,
//                "internalType": "uint256"
//            }
//        ],
//        "anonymous": false
//    },
//    {
//        "name": "ApprovalForAll",
//        "type": "event",
//        "inputs": [
//            {
//                "name": "owner",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            },
//            {
//                "name": "operator",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            },
//            {
//                "name": "approved",
//                "type": "bool",
//                "indexed": false,
//                "internalType": "bool"
//            }
//        ],
//        "anonymous": false
//    },
//    {
//        "name": "OwnershipTransferred",
//        "type": "event",
//        "inputs": [
//            {
//                "name": "previousOwner",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            },
//            {
//                "name": "newOwner",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            }
//        ],
//        "anonymous": false
//    },
//    {
//        "name": "Transfer",
//        "type": "event",
//        "inputs": [
//            {
//                "name": "from",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            },
//            {
//                "name": "to",
//                "type": "address",
//                "indexed": true,
//                "internalType": "address"
//            },
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "indexed": true,
//                "internalType": "uint256"
//            }
//        ],
//        "anonymous": false
//    },
//    {
//        "name": "PROVENANCE_HASH",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "string",
//                "internalType": "string"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "approve",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "to",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "balanceOf",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "owner",
//                "type": "address",
//                "internalType": "address"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "flipSaleState",
//        "type": "function",
//        "inputs": [],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "getApproved",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "address",
//                "internalType": "address"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "getLastMintedTokenId",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "getMintPrice",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "getStakeDuration",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "getStakeRequired",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "isApprovedForAll",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "owner",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "operator",
//                "type": "address",
//                "internalType": "address"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "bool",
//                "internalType": "bool"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "max_mustachios",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "name",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "string",
//                "internalType": "string"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "owner",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "address",
//                "internalType": "address"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "ownerOf",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "address",
//                "internalType": "address"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "purchaseMint",
//        "type": "function",
//        "inputs": [],
//        "outputs": [],
//        "stateMutability": "payable"
//    },
//    {
//        "name": "renounceOwnership",
//        "type": "function",
//        "inputs": [],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "reserveMustachios",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "accounts",
//                "type": "address[]",
//                "internalType": "address[]"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "safeTransferFrom",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "from",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "to",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "safeTransferFrom",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "from",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "to",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "internalType": "uint256"
//            },
//            {
//                "name": "_data",
//                "type": "bytes",
//                "internalType": "bytes"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "saleIsActive",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "bool",
//                "internalType": "bool"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "setApprovalForAll",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "operator",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "approved",
//                "type": "bool",
//                "internalType": "bool"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "setBaseUri",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "_baseUri",
//                "type": "string",
//                "internalType": "string"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "setLastMintedTokenId",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "_value",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "setMintPrice",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "_mintPrice",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "setProvenanceHash",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "_provenanceHash",
//                "type": "string",
//                "internalType": "string"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "setStakeDuration",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "_stakeDuration",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "setStakeRequired",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "_stakeRequired",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "stakeMint",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "nftStakingAddress",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "stakingItemId",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "supportsInterface",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "interfaceId",
//                "type": "bytes4",
//                "internalType": "bytes4"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "bool",
//                "internalType": "bool"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "symbol",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "string",
//                "internalType": "string"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "tokenByIndex",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "index",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "tokenOfOwnerByIndex",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "owner",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "index",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "tokenURI",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [
//            {
//                "name": "",
//                "type": "string",
//                "internalType": "string"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "totalSupply",
//        "type": "function",
//        "inputs": [],
//        "outputs": [
//            {
//                "name": "",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "stateMutability": "view"
//    },
//    {
//        "name": "transferFrom",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "from",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "to",
//                "type": "address",
//                "internalType": "address"
//            },
//            {
//                "name": "tokenId",
//                "type": "uint256",
//                "internalType": "uint256"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "transferOwnership",
//        "type": "function",
//        "inputs": [
//            {
//                "name": "newOwner",
//                "type": "address",
//                "internalType": "address"
//            }
//        ],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    },
//    {
//        "name": "withdraw",
//        "type": "function",
//        "inputs": [],
//        "outputs": [],
//        "stateMutability": "nonpayable"
//    }
//]',
//            'contractAddress' => '0x7de755985e7079a07bfc4919c770450436d413a9',
//            'tokenId' => 102,
//            'key' => '6cqiz1n514dmkgcmtijqv4du776my4q349acjuz5'
//        ]);
//
//        $response = Http::get('http://142.93.51.143:8080');
//
//        return $response;

//        $token = Token::find(100);
//
//        $name = $token['id'] . '.jpg';
//        $img = Image::make($token->thumbnail);
//        $dimension = 512;
//
//        $img->resize(($img->width() >= $img->height()) ? $dimension : null, ($img->width() < $img->height()) ? $dimension : null, function ($constraint) {
//            $constraint->aspectRatio();
//        });
//
//        $img->stream('jpg', 100);
//        Storage::put('public/thumbnails/' . $name, $img);
//
//        return 'success';

//        return Token::addSelect(DB::raw('token_id as id'))
//            ->addSelect('tokens.name')
//            ->addSelect('contract_address')
//            ->addSelect('chain_id')
//            ->addSelect('collections.id as asasas')
//            ->addSelect(DB::raw('null as url_placeholder'))
//            ->addSelect('thumbnail')
//            ->addSelect(DB::raw('collections.name as collection'))
//            ->addSelect(DB::raw('"token" as type'))
//            ->leftJoin('collections', 'collection_id', 'collections.id')
//            ->where('tokens.name', 'LIKE', '%Muncher%')
//            ->get();

//        Mail::send('welcome', [], function ($message) {
//            $message->to('bernardhistorillo1@gmail.com');
//        });
//
//        return 'sent';

//        return Token::select('tokens.id', 'tokens.token_id', 'collection_id', 'tokens.name', 'tokens.description', 'image', 'thumbnail', 'attributes', 'priority', 'to', 'transaction_hash', 'collections.contract_address', 'abi', 'collections.chain_id', 'supply', 'url_placeholder')
//            ->leftJoin('collections', 'collection_id', 'collections.id')
//            ->join('token_transfers', function($join) {
//                $join->on('token_transfers.id', 'token_transfer_id');
//                $join->where('to', 'LIKE', '0xE2693e68EFea76424C0D8e9b6456BD797E486755');
//            })
//            ->get();

//        $collection = Collection::where('url_placeholder', 'rewards')
//            ->first();
//
//        $response = Http::post(config('ownly.nodejs_url') . '/web3/claimElixir', [
//            'rpcUrl' => $collection->rpcUrl(),
//            'contractAddress' => $collection['contract_address'],
//            'abi' => $collection['abi'],
//            'key' => config('ownly.api_key')
//        ]);
//
//        return $response;

//        $mustachios = Mustachio::get();
//
//        foreach($mustachios as $mustachio) {
//            $mustachio->thumbnail = str_replace("https://ownly.tk","https://ownly.market", $mustachio['thumbnail']);
//            $mustachio->update();
//        }
//
//        return "success";

//        return Http::post(config('ownly.nodejs_url') . '/web3/tokenHolderDiscount/getSignature', [
//            'address' => '0x768532c218f4f4e6E4960ceeA7F5a7A947a1dd61',
//            'key' => config('ownly.api_key')
//        ]);

//        $collections = Collection::where('is_curated', 1)
//            ->orderBy('updated_at', 'desc')
//            ->get();
//
//        return $collections;

        // Separate 3D Mustachios into Pathfinders and Marauders
//        $tokens = Token::where('collection_id', 9)
//            ->get();
//
//        foreach($tokens as $token) {
//            if($token['token_id'] > 100) {
//                $token->collection_id = 11;
//                $token->update();
//            }
//        }
//
//        return 'success';

//        $marketAccounts = \App\MarketAccount::get();
//
//        foreach($marketAccounts as $marketAccount) {
//            if($marketAccount['photo']) {
//                $marketAccount->photo = str_replace("https://ownly.tk","https://ownly.market", $marketAccount['photo']);
//                $marketAccount->update();
//            }
//        }
//
//        return "success";
//
//        $collection = Collection::find(3);
//
//        $response = Http::post(config('ownly.nodejs_url') . '/web3/getMarketItem', [
//            'rpcUrl' => $collection->rpcUrl(),
//            'abi' => $collection->marketplaceContractAbi(),
//            'marketplaceContractAddress' => $collection->marketplaceContractAddress(),
//            'contractAddress' => $collection['contract_address'],
//            'tokenId' => 1,
//            'key' => config('ownly.api_key')
//        ]);
//
//        return $response;
//
//        $tokens = Token::get();
//
//        foreach($tokens as $token) {
//            $token->thumbnail = str_replace("https://ownly.tk","https://ownly.market", $token['thumbnail']);
//            $token->update();
//        }
//
//        return "success";
//
//        $tokens = Token::select('tokens.id', 'tokens.token_id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
//            ->where('collection_id', 4)
//            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
//            ->pluck('to');
//
//        $string = '';
//        foreach($tokens as $token) {
//            $string .= $token . '<br>';
//        }
//
//        return $string;
    }

//Route::get('/try', function () {
//    $marketAccounts = \App\MarketAccount::get();
//
//    foreach($marketAccounts as $marketAccount) {
//        if($marketAccount['photo']) {
//            $marketAccount->photo = str_replace("https://ownly.tk","https://ownly.market", $marketAccount['photo']);
//            $marketAccount->update();
//        }
//    }
//
//    return "success";

//    $collection = Collection::find(3);
//
//    $response = Http::post(config('ownly.nodejs_url') . '/web3/getMarketItem', [
//        'rpcUrl' => $collection->rpcUrl(),
//        'abi' => $collection->marketplaceContractAbi(),
//        'marketplaceContractAddress' => $collection->marketplaceContractAddress(),
//        'contractAddress' => $collection['contract_address'],
//        'tokenId' => 1,
//        'key' => config('ownly.api_key')
//    ]);
//
//    return $response;

//    $tokens = Token::get();
//
//    foreach($tokens as $token) {
//        $token->thumbnail = str_replace("https://ownly.tk","https://ownly.market", $token['thumbnail']);
//        $token->update();
//    }
//
//    return "success";

//    $tokens = Token::select('tokens.id', 'tokens.token_id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
//        ->where('collection_id', 4)
//        ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
//        ->pluck('to');
//
//    $string = '';
//    foreach($tokens as $token) {
//        $string .= $token . '<br>';
//    }
//
//    return $string;
//});

//Route::get('/mustachioquest/playtest', function () {
//    return view('mustachioquest.index');
//});

//Route::get('/sdfkjahsdkjshdf6s87dfsdfbskdfbskdfs867sd85h5fd64jd74j7sdfikkajhgas5sdf98s7d6fdsvnxcvmsdflsdfoiysdf5', function () {
//    // Display of owned reward tokens
//    $owned_rewards_tokens = RewardsToken::select('rewards_tokens.id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash', 'contract_address')
//        ->addSelect(DB::raw('"' . config('ownly.chain_id_matic') . '" as chain_id'))
//        ->join('token_transfers', function($join) {
//            $join->on('rewards_tokens.id', 'token_id');
//            $join->where('contract_address', config('ownly.contract_address_rewards'));
//            $join->where('to', '0x768532c218f4f4e6e4960ceea7f5a7a947a1dd61');
//            $join->where('is_current', 1);
//        });
//
//    return $owned_rewards_tokens->get();

    // Display Remaining Mustachios
//    $mustachios = \App\Mustachio::where('exists', 0)
//        ->get();
//
//    return view('mustachios', compact('mustachios'));
//});

//Route::get('/fCIvHXImVHnRoLllk7UtEGVPAgMAZtG6hn4jEbjDmgUf3p5iycaQoZ8IC3jwgDBaM05eHfFT9KoeVpDeLSC4vq8V5GiVBAhDwOfq', function () {
//    $mustachio_subscribers = MustachioSubscriber::orderBy('id', 'desc')
//        ->get();
//
//    $table = '    <table border="1" cellpadding="10">';
//
//    foreach($mustachio_subscribers as $mustachio_subscriber) {
//        $table .= '    <tr>';
//        $table .= '    <td>' . $mustachio_subscriber['id'] . '</td>';
//        $table .= '    <td>' . \Carbon\Carbon::parse($mustachio_subscriber['created_at'])->isoFormat('llll') . '</td>';
//        $table .= '    <td>' . $mustachio_subscriber['email_address'] . '</td>';
//        $table .= '    </tr>';
//    }
//
//    $table .= '    </table>';
//
//    return $table;
//});

//Route::get('/ownlyblockchainmeetupjoazguxchymclwyhmabvhdkwokvdnjswzqikjteqavynsoparkjllqcvmlhe', function () {
//    $signups = BBMSignup::orderBy('id', 'desc')
//        ->get();
//
//    $table = '    <table border="1" cellpadding="10">';
//
//    foreach($signups as $signup) {
//        $table .= '    <tr>';
//        $table .= '    <td>' . $signup['name'] . '</td>';
//        $table .= '    <td>' . $signup['email'] . '</td>';
//        $table .= '    <td>' . $signup['organization'] . '</td>';
//        $table .= '    <td>' . $signup['reason'] . '</td>';
//        $table .= '    <td>' . \Carbon\Carbon::parse($signup['created_at'])->setTimezone('Asia/Manila')->isoFormat('llll') . '</td>';
//        $table .= '    </tr>';
//    }
//
//    $table .= '    </table>';
//
//    return $table;
//});

//Route::get('/2021-sales', function () {
//    $date = Carbon::parse('2021-01-01');
//
//    $sales = TokenTransfer::where('value', '>', 0)
//        ->where('signed_at', '>=', $date->format('Y-01-01 00:00:00'))
//        ->where('signed_at', '<=', $date->format('Y-12-31 23:59:59'))
//        ->orderBy('signed_at', 'desc')
//        ->get();
//
//    $eth['usd'] = 0;
//    $eth['amount'] = 0;
//
//    $bnb['usd'] = 0;
//    $bnb['amount'] = 0;
//
//    $own['usd'] = 0;
//    $own['amount'] = 0;
//    $total = 0;
//
//    foreach($sales as $sale) {
//        if($sale['currency'] == "ETH") {
//            $date = Carbon::parse($sale['signed_at'])->format('Y-m-d');
//
//            $response = Http::get('https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/1/USD/0xc02aaa39b223fe8d0a0e5c4f27ead9083c756cc2/?quote-currency=USD&format=JSON&from=' . $date . '&to=' . $date . '&key=ckey_docs');
//
//            $eth['amount'] += $sale['value'];
//            $eth['usd'] += $response['data']['prices'][0]['prices'][0]['price'] * $sale['value'];
//
//            $total += $response['data']['prices'][0]['prices'][0]['price'] * $sale['value'];
//        } else if($sale['currency'] == "OWN") {
//            $own['amount'] += $sale['value'];
//            $own['usd'] += 0.00020144 * $sale['value'];
//
//            $total += 0.00020144 * $sale['value'];
//        } else if($sale['currency'] == "BNB") {
//            $bnb['amount'] += $sale['value'];
//            $bnb['usd'] += 314.64 * $sale['value'];
//
//            $total += 314.64 * $sale['value'];
//        }
//    }
//
//    return view('sales-2021', compact('eth', 'bnb', 'own', 'total'));
//});
}
