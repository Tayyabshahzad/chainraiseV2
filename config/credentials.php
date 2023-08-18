<?php

return [
    'auth0' => [ 
        'production' => [
            'url' => 'https://fortress-prod.us.auth0.com/oauth/token',
            'grant_type' => 'password',
            'username' => 'info@chainraise.io',
            'password' => 'F$95%5h$FMTDu#3YUZBSzk',
            'audience' => 'https://fortressapi.com/api',
            'client_id' => 'cNjCgEyfVDyBSxCixDEyYesohVwdNICH',
        ],
        'sandbox' => [ 
            'url' => 'https://fortress-sandbox.us.auth0.com/oauth/token',
            'grant_type' => 'password',
            'username' => 'tayyabshahzad@sublimesolutions.org',
            'password' => 'x0A1PGhevtkJu4qeXBXF',
            'audience' => 'https://fortressapi.com/api',
            'client_id' => 'pY6XoVugk1wCYYsiiPuJ5weqMoNUjXbn',
        ],
    ],
    'api' => [
        'production' => 'https://api.fortressapi.com',
        'sandbox'    => 'https://api.sandbox.fortressapi.com',
    ],
];

 
 
 