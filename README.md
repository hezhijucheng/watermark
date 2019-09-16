# watermark
===

## 图片增加水印


## 安装

### Composer

watermark采用composer进行安装，要使用watermark功能，只需要在composer.json中添加如下依赖：

```json
{
  "require": {
    "juchengit/watermark": "1.*"
  }
}
```


### 手动

1. 手动下载或clone最新版本watermark代码
2. 把watermark放入项目目录
3. `require` watermark src目录下面的WaterMark.php，即可使用，如把watermark放在当前目录下，只需要:

```php
require __DIR__ . "/upload/src/WaterMark.php";
```

## 用法


- **app唤起支付**

```php
$pic_path="http://p0.meituan.net/128.180/movie/4c01895cfd53e82f7c3048c407974a6b4739229.jpg"//支持绝对路径和网址
$water=new \watermark\WaterMark();
$water->text_color=[220,220,220];//虹路蓝三色比例
$water->fontfile='./src/font/msyh.ttf';
$water->inter_w=50;//水印文字间隔宽
$water->inter_h=50;//水印文字间隔宽
$water->maker_text="合智聚成";//水印文字
$water->text_size=10;//水印文字大小
$water->text_angle=50;//水印倾斜角度  0是平行  90是垂直
$water->save_path="./upload";//默认保存路径
$water->addWaterMark();
```
