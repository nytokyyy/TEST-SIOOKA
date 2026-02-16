<?php

return [
    'paths' => ['api/*'],                 
    'allowed_methods' => ['*'],           
    'allowed_origins' => [env('CORS_ALLOWED_ORIGIN', 'http://localhost:5173')], 
    'allowed_headers' => ['*'],           
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,       
];