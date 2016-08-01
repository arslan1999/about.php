<?php
function create_img($text){
    $img_area = imagecreatetruecolor(1000, 1100);
    $bg_color = imagecolorallocate($img_area, 0, 200, 200);
    $text_color = imagecolorallocate($img_area, 200, 0, 200);
    $text_font = realpath(__DIR__. '/Lobster-Regular.ttf');
    imagefill($img_area, 0, 0, $bg_color);

    imagettftext($img_area, 40, 0, 400, 100, $text_color, $text_font, 'Сертификат');
    imagettftext($img_area, 40, 0, 50, 250, $text_color, $text_font, $text);

    imagepng($img_area);
    imagedestroy($img_area);

}
header('Content-type: image/png');
$text = 'Привет '.$_GET['user_name'].'Это твой сертификат.'.PHP_EOL.' Оценка за работу '.$_GET['mark'];
create_img($text);
