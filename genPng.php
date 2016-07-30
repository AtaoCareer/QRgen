<?php
header("Content-type: image/png");
//要生成的字符串
$text = '510-1282';
//背景的大小
$width = 100;
$height = 30;
//创建画布
$im = imagecreate($width, $height);
//给画布添加背景色
$backColor = imagecolorallocate($im, 255, 255, 255);
//给文本设定颜色
$textColor = imagecolorallocate($im, 0, 0, 0);
/*
 * 将文本添加到背景色中
 */
imagestring($im, 5, 15, 8, $text, $textColor);

imagepng($im,'QR/num.png');
imagedestroy($im);

