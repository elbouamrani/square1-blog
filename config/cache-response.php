<?php

return [
    'active'    => env('CACHE_RESPONSE_ACTIVE', false),
    'lifetime'  => (int) env('CACHE_RESPONSE_LIFETIME', 259200),
];