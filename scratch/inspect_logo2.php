<?php
$im = imagecreatefrompng('public/assets/logo/logo2.png');
$w = imagesx($im);
$h = imagesy($im);
echo "Image size: {$w}x{$h}\n";

$points = [
    [0, 0], [1, 1], [2, 2], [10, 10],
    [$w-1, 0], [$w-2, 1], [$w-10, 10],
    [0, $h-1], [1, $h-2],
    [$w-1, $h-1], [$w-2, $h-2],
    [200, 0], [200, 1], [200, 5],
];

foreach ($points as [$x, $y]) {
    $rgb = imagecolorat($im, $x, $y);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
    echo "Pixel ($x, $y): rgb($r, $g, $b)\n";
}
