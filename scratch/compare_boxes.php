<?php
function getBBox($im) {
    $w = imagesx($im);
    $h = imagesy($im);
    $minX = $w; $maxX = 0; $minY = $h; $maxY = 0;
    for ($y = 2; $y < $h - 2; $y++) {
        for ($x = 2; $x < $w - 2; $x++) {
            $rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            // if not white
            if ($r < 240 || $g < 240 || $b < 240) {
                if ($x < $minX) $minX = $x;
                if ($x > $maxX) $maxX = $x;
                if ($y < $minY) $minY = $y;
                if ($y > $maxY) $maxY = $y;
            }
        }
    }
    return [$minX, $minY, $maxX, $maxY];
}

$imUpload = imagecreatefromjpeg('C:/Users/marke/.gemini/antigravity-ide/brain/03838504-1123-4a68-8bd9-0e3a71be5b98/.user_uploaded/media_1790671014665.jpg');
$imOld = imagecreatefrompng('public/assets/logo/logo2.png');

echo "Upload bounding box (ignoring 2px border): " . json_encode(getBBox($imUpload)) . "\n";
echo "Old logo2 bounding box: " . json_encode(getBBox($imOld)) . "\n";
