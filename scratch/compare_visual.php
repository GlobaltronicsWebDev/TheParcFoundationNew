<?php
$upload = imagecreatefromjpeg('C:/Users/marke/.gemini/antigravity-ide/brain/03838504-1123-4a68-8bd9-0e3a71be5b98/.user_uploaded/media_1790671014665.jpg');
$parc = imagecreatefrompng('public/assets/logo/parclogo.png');

echo "Upload dimensions: " . imagesx($upload) . "x" . imagesy($upload) . "\n";
echo "parclogo dimensions: " . imagesx($parc) . "x" . imagesy($parc) . "\n";
