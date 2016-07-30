<?php
//文件输出
include('phpqrcode/phpqrcode.php');
// 二维码数据中保存的数据
$data = 'http://www.baidu.com';
// 纠错级别：L、M、Q、H
//L-默认识别损失7%的数据
//M-15%
//Q-25%
//H-30%
$errorCorrectionLevel = 'H';
// 点的大小：1到10
$matrixPointSize = 5;
// 生成的文件名
$filename = 'QR/test'.$errorCorrectionLevel.$matrixPointSize.'.png';
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
echo "产生成功";
$logo = 'QR/num.png';
$QR = 'QR/testH10.png';
if ($logo !== FALSE) {  
	//
    $QR = imagecreatefromstring ( file_get_contents ( $QR ) );    
    $logo = imagecreatefromstring ( file_get_contents ( $logo ) );
    //imagesx 取得图像的宽度
    //imagesy 取得图像的高度
    $QR_width = imagesx ( $QR );    
    $QR_height = imagesy ( $QR );    
    $logo_width = imagesx ( $logo );    
    $logo_height = imagesy ( $logo );    
    $logo_qr_width = $QR_width / 3;    
    $scale = $logo_width / $logo_qr_width;    
    $logo_qr_height = $logo_height / $scale;    
    $from_width = ($QR_width - $logo_qr_width) / 2;  
    // 组合图片  
    imagecopyresampled ( $QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height );    
}    
imagepng ( $QR, 'QR/result.png' ); 
echo "合成成功";
?>