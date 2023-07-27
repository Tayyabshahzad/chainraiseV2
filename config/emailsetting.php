<?php

return [
    'email' => [ 
        'sandbox' => [
            'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => 'sandbox.smtp.mailtrap.io',
            'MAIL_PORT' => 2525,
            'MAIL_USERNAME' => '321f3f5e112709',
            'MAIL_PASSWORD' => '1a9a86e7093f03',
            'MAIL_ENCRYPTION' => 'tls',
            'MAIL_FROM_ADDRESS' => 'noreply@investchainraise.io',
            'MAIL_FROM_NAME' => '${APP_NAME}',
        ],
        'production' => [ 
            'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => 'smtp.gmail.io',
            'MAIL_PORT' => 465,
            'MAIL_USERNAME' => 'tayyabshahzad@sublimesolutions.org',
            'MAIL_PASSWORD' => 'Pakistan@9794881',
            'MAIL_ENCRYPTION' => 'tls',
            'MAIL_FROM_ADDRESS' => 'noreply@investchainraise.io',
            'MAIL_FROM_NAME' => '${APP_NAME}',
        ],
    ], 
];

 
 