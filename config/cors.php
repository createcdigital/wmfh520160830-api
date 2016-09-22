<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |

     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => ['http://www.createcdigital.com'],
    //'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Content-Type', 'Accept'],
    'allowedMethods' => ['GET'],
    'exposedHeaders' => [],
    'maxAge' => 0,
    'hosts' => [],
];

