<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenTransfer extends Model
{
    public function collection() {
        return Collection::where('chain_id', $this->chain_id)
            ->where('contract_address', 'LIKE', $this->contract_address)
            ->first();
    }

    public function token() {
        $collection = $this->collection();

        return Token::where('collection_id', $collection['id'])
            ->where('token_id', $this->token_id)
            ->first();
    }
}
