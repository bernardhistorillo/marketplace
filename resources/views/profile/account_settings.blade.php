@extends('layouts.app')

@section('title', 'Profile')
@section('og_title', 'Profile')
@section('og_image', asset('img/og/home.png'))

@section('content')
<form id="account-settings-form">
    <div class="row">
        <div class="col-lg-6 order-1 order-lg-0">
            <div class="mb-4 mb-lg-5">
                <label class="neo-bold mb-2" for="username">Username</label>
                <input type="text" class="form-control py-2 py-lg-3 px-3" name="username" placeholder="Enter Username" id="username" style="border-width:2px" required disabled />
            </div>

            <div class="mb-4 mb-lg-5">
                <label class="neo-bold mb-2" for="email-address">Email Address</label>
                <input type="text" class="form-control py-2 py-lg-3 px-3" name="email_address" placeholder="Enter Email Address" id="email-address" style="border-width:2px" required disabled />
            </div>

            <div class="mb-5">
                <label class="neo-bold mb-2" for="bio">Bio</label>
                <input type="text" class="form-control py-2 py-lg-3 px-3" name="bio" placeholder="Enter who you are or your interests" id="bio" style="border-width:2px" disabled />
            </div>

            <div class="text-center text-lg-start mb-4 mb-lg-5">
                <button type="submit" class="btn btn-custom-6 py-2 py-lg-3 px-5 action-btn d-none" style="border-radius:29px">Save Changes</button>
            </div>
        </div>

        <div class="col-lg-6 order-0 order-lg-1 mb-5 mb-lg-0">
            <div class="mx-4 mx-sm-5 px-5 px-lg-0 px-xxl-5">
                <div class="mx-sm-5 px-md-5 px-lg-4">
                    <div class="w-100 background-image-cover rounded-circle mb-4 position-relative bg-white" id="photo-container" style="padding-top:100%; border:3px solid #aaaaaa"></div>
                    <div class="text-center">
                        <input type="file" class="d-none" name="photo" accept="image/*" />
                        <button type="button" class="btn btn-custom-13 px-5 action-btn d-none" id="select-photo" style="border-radius:29px">Select Photo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
