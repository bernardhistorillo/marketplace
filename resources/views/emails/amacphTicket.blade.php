<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">--}}
{{--    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">--}}

    <style>
        * {
            font-family: "Segoe UI", serif !important;
        }
        .p-4 {
            padding:24px;
        }

        /*! CSS Used from: https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css */
        :root{--bs-blue:#0d6efd;--bs-indigo:#6610f2;--bs-purple:#6f42c1;--bs-pink:#d63384;--bs-red:#dc3545;--bs-orange:#fd7e14;--bs-yellow:#ffc107;--bs-green:#198754;--bs-teal:#20c997;--bs-cyan:#0dcaf0;--bs-black:#000;--bs-white:#fff;--bs-gray:#6c757d;--bs-gray-dark:#343a40;--bs-gray-100:#f8f9fa;--bs-gray-200:#e9ecef;--bs-gray-300:#dee2e6;--bs-gray-400:#ced4da;--bs-gray-500:#adb5bd;--bs-gray-600:#6c757d;--bs-gray-700:#495057;--bs-gray-800:#343a40;--bs-gray-900:#212529;--bs-primary:#0d6efd;--bs-secondary:#6c757d;--bs-success:#198754;--bs-info:#0dcaf0;--bs-warning:#ffc107;--bs-danger:#dc3545;--bs-light:#f8f9fa;--bs-dark:#212529;--bs-primary-rgb:13,110,253;--bs-secondary-rgb:108,117,125;--bs-success-rgb:25,135,84;--bs-info-rgb:13,202,240;--bs-warning-rgb:255,193,7;--bs-danger-rgb:220,53,69;--bs-light-rgb:248,249,250;--bs-dark-rgb:33,37,41;--bs-white-rgb:255,255,255;--bs-black-rgb:0,0,0;--bs-body-color-rgb:33,37,41;--bs-body-bg-rgb:255,255,255;--bs-font-sans-serif:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans","Liberation Sans",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--bs-font-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--bs-gradient:linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));--bs-body-font-family:var(--bs-font-sans-serif);--bs-body-font-size:1rem;--bs-body-font-weight:400;--bs-body-line-height:1.5;--bs-body-color:#212529;--bs-body-bg:#fff;--bs-border-width:1px;--bs-border-style:solid;--bs-border-color:#dee2e6;--bs-border-color-translucent:rgba(0, 0, 0, 0.175);--bs-border-radius:0.375rem;--bs-border-radius-sm:0.25rem;--bs-border-radius-lg:0.5rem;--bs-border-radius-xl:1rem;--bs-border-radius-2xl:2rem;--bs-border-radius-pill:50rem;--bs-link-color:#0d6efd;--bs-link-hover-color:#0a58ca;--bs-code-color:#d63384;--bs-highlight-bg:#fff3cd;}
        *,::after,::before{box-sizing:border-box;}
        @media (prefers-reduced-motion:no-preference){
            :root{scroll-behavior:smooth;}
        }
        body{margin:0;font-family:var(--bs-body-font-family);font-size:var(--bs-body-font-size);font-weight:var(--bs-body-font-weight);line-height:var(--bs-body-line-height);color:var(--bs-body-color);text-align:var(--bs-body-text-align);background-color:var(--bs-body-bg);-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent;}
        h1,h5,h6{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;color:var(--bs-heading-color);}
        h1{font-size:calc(1.375rem + 1.5vw);}
        @media (min-width:1200px){
            h1{font-size:2.5rem;}
        }
        h5{font-size:1.25rem;}
        h6{font-size:1rem;}
        p{margin-top:0;margin-bottom:1rem;}
        ul{padding-left:2rem;}
        ul{margin-top:0;margin-bottom:1rem;}
        img{vertical-align:middle;}
        table{caption-side:bottom;border-collapse:collapse;}
        tbody,td,tr{border-color:inherit;border-style:solid;border-width:0;}
        ::-moz-focus-inner{padding:0;border-style:none;}
        .border-0{border:0!important;}
        .w-100{width:100%!important;}
        .mb-3{margin-bottom:1rem!important;}
        .p-4{padding:1.5rem!important;}
        .fw-bold{font-weight:700!important;}
        .text-center{text-align:center!important;}
        /*! CSS Used from: http://ownly-api.test/css/app.css?id=781ae7cc1c28ef7627ea */
        *{line-height:1.2em;}
        html{scroll-behavior:smooth;}
        .background-image-cover{background-position:center;background-repeat:no-repeat;background-size:cover;}
        ::-webkit-scrollbar{width:8px;height:8px;}
        ::-webkit-scrollbar-track{background:#f3f3f3;}
        ::-webkit-scrollbar-thumb{background-color:#606060;border-radius:4px;}
        /*! CSS Used from: Embedded */
        *{font-family:"Segoe UI", serif!important;}
        .p-4{padding:24px;}
        /*! CSS Used fontfaces */
    </style>
</head>

<body>
    <div class="w-100" style="min-width:400px; max-width:600px">
        <div class="text-center background-image-cover p-4" style="background-image:url('https://amac.ph/static/media/banner.4ae4895b.jpg')">
            <img src="https://ownly.market/img/logo/amacph.png" class="mb-3" width="180" />

            <h5 class="fw-bold" style="color:#bbebd6">Exploring the intersection of art&nbsp;and&nbsp;technology</h5>
            <h6 style="color:#ffffff">October 8-9, 2022 | Ayala Malls Legazpi</h6>
        </div>

        <div class="p-4" style="background-color:#fcf3f2">
            <p>Hey, {{ $amacRegistrant['firstname'] }}.</p>
            <p>Today, you took that extra step in exploring the intersection of art and technology.</p>
            <p>Enclosed in this email is your virtual ticket to attend Albay Multimedia Arts Convention, the biggest event celebrating creativity through art and tech in South Luzon happening on October 8-9, 2022 at Ayala Malls Legazpi.</p>

            <table class="border-0" style="width:100%; margin-bottom:20px">
                <tr>
                    <td class="background-image-cover" style="background-image:url('https://amac.ph/static/media/banner.4ae4895b.jpg'); width:75%; height:150px; border-radius:10px 0 0 10px">
                        <table class="border-0">
                            <tr>
                                <td style="padding-left:5px">
                                    <img src="https://ownly.market/img/logo/amacph.png" width="60" />
                                </td>
                                <td style="padding-left:5px; padding-right:5px">
                                    <h1 class="fw-bold" style="font-size:24px; color:#bbebd6; margin-bottom:5px">AMAC&nbsp;2022</h1>
                                    <h6 class="" style="font-size:11px; color:#bbebd6; margin-bottom:3px">Exploring the intersection of art&nbsp;and&nbsp;technology</h6>
                                    <h6 class="" style="font-size:11px; color:#ffffff">October 8-9, 2022 | Ayala Malls Legazpi</h6>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td style="background-color: #ffb600; width:25%; height:150px; border-radius:0 10px 10px 0; padding-left:5px; padding-right:5px">
                        <div class="text-center">
                            <img src="https://ownly.market/img/amac/code.png" width="50" />
                        </div>
                        <p class="text-center fw-bold" style="font-size:10px; margin:10px 0 0 0">Ticket No. {{ str_pad($amacRegistrant['is_validated'], 3, '0', STR_PAD_LEFT) }}</p>
                    </td>
                </tr>
            </table>

            <p>With the purchase of this ticket, you get to have an AMAC 2022 X Lei Melendres shirt, a FREE Mint Slot for Mustachio Rascals NFT, and an EXCLUSIVE pass to our Art Talks Session with our gifted artists and speakers:</p>
            <ul>
                <li>Lei Melendres on Illustration with NFT</li>
                <li>Jopet Arias on Fine Art with NFT</li>
                <li>Karl Vasquez on Branding and Graphic Design with NFT</li>
                <li>John Verlin Santos on Spoken Word with NFT</li>
            </ul>
            <p>Please reply to this email your Ethereum wallet address so we can add you to our exclusive Mint List for our Mustachio Rascals NFT.</p>

            <div class="text-center" style="margin-bottom:16px">
                <img src="https://ownly.market/img/amac/rascals.gif" style="width:60%" />
            </div>

            <p>Should there be any questions, concerns, and/or clarifications about your event ticket and its inclusions, please don't hesitate to send us an email at support@ownly.io.</p>
            <p style="margin-bottom:40px">Looking forward to seeing you at the AMAC 2022!</p>
            <p>Sincerely,</p>
            <p>The Ownly Team</p>
        </div>
    </div>
</body>
</html>
