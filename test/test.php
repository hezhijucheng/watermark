<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 14:37
 */
require 'vendor/autoload.php';
$water=new \watermark\WaterMark("http://p0.meituan.net/128.180/movie/4c01895cfd53e82f7c3048c407974a6b4739229.jpg");
$water->text_color=[220,220,220];//虹路蓝三色比例
$water->fontfile='./src/font/msyh.ttf';
$water->inter_w=50;//水印文字间隔宽
$water->inter_h=50;//水印文字间隔宽
$water->maker_text="合智聚成";//水印文字
$water->text_size=10;//水印文字大小
$water->text_angle=50;//水印倾斜角度  0是平行  90是垂直
$water->save_path="./upload";//默认保存路径
$water->addWaterMark();