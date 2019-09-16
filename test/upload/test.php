<?php

/*给图片加文字水印的方法*/
$arrContextOptions=array(
	"ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
	),
);
$dst_path = 'http://p0.meituan.net/128.180/movie/4c01895cfd53e82f7c3048c407974a6b4739229.jpg';
//$dst_path = 'http://static.oschina.net/uploads/user/1483/2966154_50.jpeg';
$dst_path = str_replace("https://", "http://", $dst_path);
$a=file_get_contents($dst_path);


$dst = imagecreatefromstring($a);

/*imagecreatefromstring()--从字符串中的图像流新建一个图像，返回一个图像标示符，其表达了从给定字符串得来的图像

图像格式将自动监测，只要php支持jpeg,png,gif,wbmp,gd2.*/



$font = './msyh.ttf';

$black = imagecolorallocate($dst, 220,220,220);


/*imagefttext($img,$size,$angle,$x,$y,$color,$fontfile,$text)

$img由图像创建函数返回的图像资源

size要使用的水印的字体大小

angle（角度）文字的倾斜角度，如果是0度代表文字从左往右，如果是90度代表从上往下

x,y水印文字的第一个文字的起始位置

color是水印文字的颜色

fontfile，你希望使用truetype字体的路径*/


list($dst_w,$dst_h,$dst_type) = getimagesize($dst_path);

/*list(mixed $varname[,mixed $......])--把数组中的值赋给一些变量

像array()一样，这不是真正的函数，而是语言结构，List()用一步操作给一组变量进行赋值*/

/*getimagesize()能获取到什么信息？

getimagesize函数会返回图像的所有信息，包括大小，类型等等*/

$postions_arr=getPostion($dst_w,$dst_h);
foreach ($postions_arr as $v){
	imagefttext($dst, 10, 50, $v[0], $v[1], $black, $font, '和值聚成');

}
function getPostion($dst_w,$dst_h,$inter_w=50,$inter_h=50){
	$hight_num=ceil($dst_h/$inter_h);
	$wight_num=ceil($dst_w/$inter_w);
	if($hight_num>0&&$wight_num>0){
		for($i=0;$i<$wight_num;$i++){
			for($j=0;$j<$hight_num;$j++){
				$data[0]=$inter_w*$i;
				$data[1]=$inter_h*$j;
				$postions[]=$data;
			}
		}
	}
	return $postions;
}

switch($dst_type){

	case 1://GIF

		header("content-type:image/gif");

		imagegif($dst);

		break;

	case 2://JPG

		header("content-type:image/jpeg");

		imagejpeg($dst);

		break;

	case 3://PNG

		header("content-type:image/png");

		imagepng($dst);

		break;

	default:

		break;

	/*imagepng--以PNG格式将图像输出到浏览器或文件

	imagepng()将GD图像流(image)以png格式输出到标注输出（通常为浏览器），或者如果用filename给出了文件名则将其输出到文件*/

}

imagedestroy($dst);

?>