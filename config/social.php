<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Social Media Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi URL media sosial untuk Kampung Gatot
    |
    */

    'tiktok' => env('SOCIAL_TIKTOK_URL', 'https://www.tiktok.com/@kampunggatot'),
    'youtube' => env('SOCIAL_YOUTUBE_URL', 'https://www.youtube.com/@kampunggatot'),
    'instagram' => env('SOCIAL_INSTAGRAM_URL', 'https://www.instagram.com/kampunggatot'),
    'facebook' => env('SOCIAL_FACEBOOK_URL', 'https://www.facebook.com/kampunggatot'),
    'twitter' => env('SOCIAL_TWITTER_URL', 'https://twitter.com/kampunggatot'),
    
    // Popup settings
    'popup_delay' => env('SOCIAL_POPUP_DELAY', 2000), // milliseconds
    'show_popup' => env('SOCIAL_SHOW_POPUP', true),
];
