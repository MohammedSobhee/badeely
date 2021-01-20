<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => 'AAAA3PZSqLQ:APA91bFMvteUjfd7d5yFJ1tLmq2D6xAwOWkDijw9jX93ezpQTwvtFQ95f-291DJwfSneKqgMa2gJpQDgsIIyM8DEySESGM9mguWu6e3UDISuHS8J_dvF8w3gS8To8ueIYcVkrViHB_xd',
        'sender_id' => '949025417396',
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
