<?php
$sourcePath = 'C:/Users/marke/.gemini/antigravity-ide/brain/03838504-1123-4a68-8bd9-0e3a71be5b98/.user_uploaded/media_1790671014665.jpg';
$logo2Path  = 'public/assets/logo/logo2.png';
$logoPath   = 'public/assets/logo/logo.png';
$receiptLogoPath = 'public/assets/image/parclogo.png';

// 1. Backup existing files
if (file_exists($logo2Path) && !file_exists('public/assets/logo/logo2_backup.png')) {
    copy($logo2Path, 'public/assets/logo/logo2_backup.png');
}
if (file_exists($logoPath) && !file_exists('public/assets/logo/logo_backup.png')) {
    copy($logoPath, 'public/assets/logo/logo_backup.png');
}

// 2. Load uploaded JPEG
$src = imagecreatefromjpeg($sourcePath);
$w = imagesx($src);
$h = imagesy($src);

// Create truecolor canvas
$dst = imagecreatetruecolor($w, $h);
$white = imagecolorallocate($dst, 255, 255, 255);
imagefill($dst, 0, 0, $white);

// Copy source
imagecopy($dst, $src, 0, 0, 0, 0, $w, $h);

// Clean up the 1-2px grey boundary artifact from the screenshot so it is clean white
for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        // If within 2px of the outer edge, clear to pure white
        if ($x <= 1 || $x >= $w - 2 || $y <= 1 || $y >= $h - 2) {
            imagesetpixel($dst, $x, $y, $white);
        }
    }
}

// Ensure public/assets/image directory exists
if (!is_dir('public/assets/image')) {
    mkdir('public/assets/image', 0755, true);
}

// Save as PNG
imagepng($dst, $logo2Path);
imagepng($dst, $logoPath);
imagepng($dst, $receiptLogoPath);

imagedestroy($src);
imagedestroy($dst);

echo "SUCCESS: Saved new logo to $logo2Path, $logoPath, and $receiptLogoPath\n";
