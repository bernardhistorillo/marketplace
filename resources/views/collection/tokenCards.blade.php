@foreach($tokens as $token)
    @include('collection.tokenCard')
@endforeach

<div class="col-12">
    <div class="d-flex justify-content-center font-size-80" id="token-pagination">{{ $tokens->onEachSide(1)->links() }}</div>
</div>
