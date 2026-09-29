<?php
$im = imagecreatefrompng('public/assets/logo/parclogo.png');
$rgba = imagecolorat($im, 5, 5);
$alpha = ($rgba & 0x7F000000) >> 24;
echo "parclogo.png alpha at (5,5): $alpha (127 means completely transparent)\n";

$im2 = imagecreatefrompng('public/assets/logo/logo2.png');
$rgba2 = imagecolorat($im2, 5, 5);
$alpha2 = ($rgba2 & 0x7F000000) >> 24;
echo "logo2.png alpha at (5,5): $alpha2\n";
