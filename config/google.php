<?php

return [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'version' => env('GOOGLE_VERSION'),
    'key' => env('GOOGLE_API_KEY', null),
    'safe_browsing' => [
        'method' => env('GOOGLE_API_PATH')
    ],
    'threat_types' => [
        'THREAT_TYPE_UNSPECIFIED',
        'MALWARE',
        'SOCIAL_ENGINEERING',
        'UNWANTED_SOFTWARE',
        'POTENTIALLY_HARMFUL_APPLICATION',
    ],
    'threat_platforms' => [
        'ANY_PLATFORM'
    ],
];