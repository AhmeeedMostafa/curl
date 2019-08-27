<?php

/**
 * @author AhmedMostafaElSayed
 * @copyright 2013
 */
session_start();
header('Content-Type: image/jpeg');

$_SESSION['captcha'] = rand(1000,10000);

$font_size = 44;

$image_height = 50;
$image_width = 150;

$image = imagecreate($image_width,$image_height);

imagecolorallocate($image, 190, 190, 190);
$font_color = imagecolorallocate($image, 255, 255, 255);
for($x=1; $x<=30; $x++){
    $x1 = rand(1,1100);
    $y1 = rand(1,1100);
    $x2 = rand(1,100);
    $y2 = rand(1,100);    
    imageline($image,$x1,$y1,$x2,$y2,$font_color);
}

imagettftext($image, $font_size, 0, 25, 50, $font_color, 'oneway.ttf', $_SESSION['captcha']);

imagejpeg($image);


?>
