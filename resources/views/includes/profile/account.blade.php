@if($account)
<a class="text-color-6 text-decoration-none" href="{{ route('profile.index', $account) }}" id="profile-link" data-discount-signature="{{ $discountSignature['signature'] }}" data-own-token-balance="{{ $discountSignature['ownTokenBalance'] }}">
    <div class="d-flex align-items-center">
        <div class="background-image-cover bg-color-18 profile-photo" style="background-image:url('{{ ($marketAccount && $marketAccount['photo']) ? $marketAccount['photo'] : "https://avatars.dicebear.com/api/bottts/" . $account . ".svg?scale=80" }}'); width:35px; height:35px; border-radius:50%; border:1px solid #aaaaaa"></div>
        <span class="font-size-90 ps-2">{{ shortenAddress($account, 5, 5) }}&nbsp;</span>
    </div>
</a>
@else
<button type="button" class="btn btn-custom-9 shadow-sm font-size-90 py-2 px-4" id="connect-wallet" style="border-radius:100px">Connect&nbsp;Wallet</button>
@endif
