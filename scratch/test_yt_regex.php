<?php
$urls = [
    'https://www.youtube.com/live/1sqDa6Uyvug',
    'https://www.youtube.com/watch?v=NAnJbEVWnLo',
    'https://youtu.be/iuxoo8Jxi2Q',
    'https://youtube.com/shorts/abcdef12345',
    'https://www.youtube.com/embed/1sqDa6Uyvug'
];

$pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|live|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

foreach ($urls as $url) {
    if (preg_match($pattern, $url, $m)) {
        echo "MATCH: $url -> {$m[1]} -> embed: https://www.youtube-nocookie.com/embed/{$m[1]}\n";
    } else {
        echo "FAIL: $url\n";
    }
}
