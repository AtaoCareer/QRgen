<?php

require_once dirname(__FILE__).'/phpqrcode/phpqrcode.php';
/*
 * 最后产生形如"http://32304ede.ngrok.natapp.cn/wechat/public/zichan/11111"的二维码，且二维码中间标有id号
 */
function genQR($id = "11111", $url = "http://32304ede.ngrok.natapp.cn/wechat/public/zichan/")
{
	//step1：产生二维码
	$data = $url.$id;
	$errorCorrectionLevel = 'H';
	$matrixPointSize = 5;
	$QRname = 'Output/QR'.$id.'.png';
	QRcode::png($data, $QRname, $errorCorrectionLevel, $matrixPointSize, 1);
	echo $id."的二维码产生成功"."<br>";
	//step2: 产生id图片
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
	imagestring($im, 4, 15, 8, $id, $textColor);
	$numName = 'Output/Num'.$id.'.png';
	imagepng($im, $numName);
	imagedestroy($im);
	echo $id."的数字产生成功"."<br>";
	//step3: 将图片组装在一起
	if ($numName !== FALSE) {
		//
		$QRname = imagecreatefromstring ( file_get_contents ( $QRname ) );
		$numName = imagecreatefromstring ( file_get_contents ( $numName ) );
		//imagesx 取得图像的宽度
		//imagesy 取得图像的高度
		$QRname_width = imagesx ( $QRname );
		$QRname_height = imagesy ( $QRname );
		$numName_width = imagesx ( $numName );
		$numName_height = imagesy ( $numName );
		$numName_qr_width = $QRname_width / 1.5;
		$scale = $numName_width / $numName_qr_width;
		$numName_qr_height = $numName_height / $scale;
		$from_width = ($QRname_width - $numName_qr_width) / 2;
		// 组合图片
		imagecopyresampled ( $QRname, $numName, $from_width, $from_width, 0, 0, $numName_qr_width, $numName_qr_height, $numName_width, $numName_height );
	}
	$resultName = 'Output/Result-'.$id.'.png';
	imagepng ( $QRname, $resultName);
	imagedestroy($QRname);
	echo "合成成功";
	
}
//

