<?php
function captchaGenerator()
{
    header('Content-type: image/jpeg');
    $char = 'ABCDEFGHJKLMNOPQRSTUVWXYZ23456789abcdefghjkmnopqrstuvwxyz';
    $captcha_lenght = rand(6,8);
    $captcha_num = "";
    $font = dirname(__FILE__) . '/orangejuice2.0.ttf';
    $font_size = 30;
    $img_width = 250;
    $img_height = 100;
    $image = imagecreate($img_width, $img_height);
    imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    for ($i = 0; $i < $captcha_lenght; $i++) {
        $captcha_num.=$char[rand(0, strlen($char)-1)];
        $text_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        $angle = rand(-15, 15);
        $x = ($img_width - 20) / $captcha_lenght * $i + 10;
        $x = rand($x, $x + 4);
        $y = $img_height - (($img_height - $font_size) / 2);
        imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font, $captcha_num[$i]);
    }
    imagejpeg($image);
    imagedestroy($image);
    setcookie("captcha", md5("opgoksdssmfdkpmfkwemfwkmemkp,opmvopv,".$captcha_num."wer6yuio;,mnbvcxsdfghjkmmnfdsfsd"),time()+300);
    return $captcha_num;
}

captchaGenerator();