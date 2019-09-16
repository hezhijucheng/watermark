<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 14:37
 */
require 'vendor/autoload.php';
$water=new \watermark\WaterMark("http://p0.meituan.net/128.180/movie/4c01895cfd53e82f7c3048c407974a6b4739229.jpg");

var_dump($water->addWaterMark());die();