<?php
namespace watermark;

class WaterMark
{
	private $dst_path;//图片路径绝对路径和网址
	public $text_color=[220,220,220];//虹路蓝三色比例
	public $fontfile='./src/font/msyh.ttf';
	public $inter_w=50;//水印文字间隔宽
	public $inter_h=50;//水印文字间隔宽
	public $maker_text="合智聚成";//水印文字
	public $text_size=10;//水印文字大小
	public $text_angle=50;//水印倾斜角度  0是平行  90是垂直
	public $save_path="./upload";//默认保存路径
	private $dst;//文件信息
	private $dst_w;
	private $dst_h;
	private $dst_type;

	public function __construct($dst_path)
	{
		$dst_path = str_replace("https://", "http://", $dst_path);
		$this->dst_path=$dst_path;
		$this->dst = imagecreatefromstring(file_get_contents($dst_path));
		list($dst_w,$dst_h,$dst_type) = getimagesize($dst_path);
		$this->dst_h=$dst_h;
		$this->dst_w=$dst_w;
		$this->dst_type=$dst_type;
	}

	private function getPostion(){
		$hight_num=ceil($this->dst_h/$this->inter_h);
		$wight_num=ceil($this->dst_w/$this->inter_w);
		if($hight_num>0&&$wight_num>0){
			for($i=0;$i<$wight_num;$i++){
				for($j=0;$j<$hight_num;$j++){
					$data[0]=$this->inter_w*$i;
					$data[1]=$this->inter_h*$j;
					$postions[]=$data;
				}
			}
		}
		return $postions;
	}

	public function addWaterMark(){
		$black = imagecolorallocate($this->dst, $this->text_color[0], $this->text_color[1], $this->text_color[2]);
		$postions_arr=$this->getPostion();

		foreach ($postions_arr as $v){
			imagefttext($this->dst, $this->text_size, $this->text_angle, $v[0], $v[1], $black, $this->fontfile, $this->maker_text);
		}

		$this->mkdirs($this->save_path);
		$path="";

		switch($this->dst_type){
			case 1://GIF
				$file_link_name=time().rand(0,1000);
				imagegif($this->dst,$this->save_path."/".$file_link_name.".gif");
				$path= $this->save_path."/".$file_link_name.".gif";
				break;

			case 2://JPG

				$file_link_name=time().rand(0,1000);
				imagejpeg($this->dst,$this->save_path."/".$file_link_name.".jpg");
				$path= $this->save_path."/".$file_link_name.".jpg";
				break;

			case 3://PNG
				$file_link_name=time().rand(0,1000);
				imagepng($this->dst,$this->save_path."/".$file_link_name.".png");
				$path= $this->save_path."/".$file_link_name.".png";
				break;

			default:
				$path="不符合图片格式";
				break;
		}
		imagedestroy($this->dst);
		return $path;
	}

	private function mkdirs($dir, $mode = 0777)
	{
		if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
		if (!mkdirs(dirname($dir), $mode)) return FALSE;
		return @mkdir($dir, $mode);
	}
}
