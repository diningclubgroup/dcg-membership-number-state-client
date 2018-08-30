<?php

return [
    'prod' => [
        // The membership number api URL
        'api_base_url' => 'https://mem-num-state-api.prod.diningclubgroup.com/v1',

        // The authentication token for accessing the API (brand specific, e.g. Tastecard or Gourmet)
        'api_access_token' => 'PROD_TOKEN'
    ],
    'test' => [
        // The membership number api URL
        'api_base_url' => 'https://mem-num-state-api.test.diningclubgroup.com/v1',

        // The authentication token for accessing the API (brand specific, e.g. Tastecard or Gourmet)
        'api_access_token' => 'TEST_TOKEN'
    ]
];