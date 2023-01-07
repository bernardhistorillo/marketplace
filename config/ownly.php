<?php

return [
    'version' => env('VERSION'),

    'marketplace_url' => env('MARKETPLACE_URL'),
    'nodejs_url' => env('NODEJS_URL'),

    // Chain IDs
    'chain_id_eth' => env('CHAIN_ID_ETH'),
    'chain_id_bsc' => env('CHAIN_ID_BSC'),
    'chain_id_matic' => env('CHAIN_ID_MATIC'),

    // Explorers
    'blockchain_explorer_eth' => env('BLOCKCHAIN_EXPLORER_ETH'),
    'blockchain_explorer_bsc' => env('BLOCKCHAIN_EXPLORER_BSC'),
    'blockchain_explorer_matic' => env('BLOCKCHAIN_EXPLORER_MATIC'),

    'contract_address_own_token' => strtolower(env('CONTRACT_ADDRESS_OWN_TOKEN')),

    // Collections
    'contract_address_chenink' => strtolower(env('CONTRACT_ADDRESS_CHENINK')),
    'contract_address_titans' => strtolower(env('CONTRACT_ADDRESS_TITANS')),
    'contract_address_mustachios' => strtolower(env('CONTRACT_ADDRESS_MUSTACHIOS')),
    'contract_address_3dmustachios' => strtolower(env('CONTRACT_ADDRESS_3DMUSTACHIOS')),
    'contract_address_rewards' => strtolower(env('CONTRACT_ADDRESS_REWARDS')),
    'contract_address_genesis_block' => strtolower(env('CONTRACT_ADDRESS_GENESIS_BLOCK')),
    'contract_address_the_sages_rant_collectibles' => strtolower(env('CONTRACT_ADDRESS_THE_SAGES_RANT_COLLECTIBLES')),
    'contract_address_oha' => strtolower(env('CONTRACT_ADDRESS_OHA')),

    // Marketplace
    'contract_address_marketplace_bsc' => strtolower(env('CONTRACT_ADDRESS_MARKETPLACE_BSC')),

    // Explorers API Keys
    'blockchain_explorer_api_key_eth' => env('EXPLORER_API_KEY_ETH'),
    'blockchain_explorer_api_key_bsc' => env('EXPLORER_API_KEY_BSC'),
    'blockchain_explorer_api_key_matic' => env('EXPLORER_API_KEY_MATIC'),

    'api_key' => env('API_KEY'),

    // RPC URLS
    'rpc_url_eth' => env('RPC_URL_ETH'),
    'rpc_url_bsc' => env('RPC_URL_BSC'),
    'rpc_url_matic' => env('RPC_URL_MATIC'),

    'badge_claim_message' => env('BADGE_CLAIM_MESSAGE'),
    'add_to_favorites_message' => env('ADD_TO_FAVORITES_MESSAGE'),

    'ownly_twitter_id' => env('OWNLY_TWITTER_ID'),
    'mustachioverse_twitter_id' => env('MUSTACHIOVERSE_TWITTER_ID'),
];
