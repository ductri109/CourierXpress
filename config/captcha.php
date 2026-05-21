<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['2', '3', '4', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
    'fontsDirectory' => dirname(__DIR__) . '/assets/fonts',
    'bgsDirectory' => dirname(__DIR__) . '/assets/backgrounds',
    'default' => [
        'length' => 6,
        'width' => 345,
        'height' => 65,
        'quality' => 90,
        'math' => false,
        'expire' => 60,
        'encrypt' => false,
    ],
    'flat' => [
        'length' => 4,
        'width' => 250,
        'height' => 70,
        'quality' => 90,
        'lines' => 4,
        'bgImage' => false,
        'bgColor' => '#ffffff',
        'fontColors' => ['#dc2626', '#b91c1c', '#7f1d1d'], // Đổi màu font hợp màu đỏ CourierXpress
    ],
    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],
    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => false,
        'contrast' => -5,
    ],
    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
    ],
];
