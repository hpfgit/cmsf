<?php
class ValidateCode {
    private $charset = '123456789';
    private $width = 130;
    private $height = 50;
    private $code;
    private $codelen = 4;
    private $img;
    private $font;
    private $fontsize = 20;
    private $fontcolor;
    
    public function __construct() {
        $this->font = '../font/Elephant.ttf';
    }
    //生成验证码
    private function CreateCode() {
        $len = strlen($this->charset)-1;
        for ($i=0; $i<$this->codelen; $i++) {
            $this->code .= $this->charset[mt_rand(0, $len)];
        }
    }
    //创建图像
    private function CreateImg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }
    //生成图像
    private function OutPut() {
        header("content-type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }
    //生成线条 雪花
    private function CreateLine() {
        for ($i=0; $i<6; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->height), mt_rand(0, $this->width), $this->fontcolor);
        }
        for ($i=0; $i<50; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $this->fontcolor);
        }
    }
    private function CreateFont() {
        $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
        $x = $this->width / $this->codelen;
        for ($i=0; $i<$this->codelen; $i++) {
            imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $x*$i+mt_rand(0, 10), $this->height/1.4, $this->fontcolor, $this->font, $this->code[$i]);
        }
    }
    public function run() {
        $this->CreateCode();
        $this->CreateImg();
        $this->CreateFont();
        $this->CreateLine();
        $this->OutPut();
    }
    //获取验证码
    public function GetCode() {
        return strtolower($this->code);
    }
}