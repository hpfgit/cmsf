<?php
class Image {
    private $file;
    private $width;
    private $height;
    private $type;
    private $img;
    private $new;
    
    public function __construct($file) {
        $this->file = $file;
        list($this->width, $this->height, $this->type) = getimagesize($this->file);
        $this->img = $this->getFormImg($this->file, $this->type);
    }
    public function thumb($new_width = 0, $new_height = 0) {
        if (empty($new_width) && empty($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if (!is_numeric($new_width) || !is_numeric($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        $n_w = $new_width;
        $n_h = $new_height;
        $cut_width = 0;
        $cut_height = 0;
        if ($this->width < $this->height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_height = ($new_width / $this->width) * $this->height;
        }
        if ($new_width < $n_w) {
            $r = $n_w / $new_width;
            $new_width *= $r;
            $new_height *= $r;
            $cut_height = ($new_height - $n_h) / 2;
        }
        if ($new_height < $n_h) {
            $r = $n_h / $new_height;
            $new_width *= $r;
            $new_height *= $r;
            $cut_width = ($new_width - $n_w) / 2;
        }
        $this->new = imagecreatetruecolor($n_w, $n_h);
        imagecopyresampled($this->new, $this->img, 0, 0, $cut_width, $cut_height, $new_width, $new_height, $this->width, $this->height);
    }
    private function getFormImg($file, $type) {
        switch ($type) {
            case 1:
                $img = imagecreatefromgif($file);
                break;
            case 2:
                $img = imagecreatefromjpeg($file);
                break;
            case 3:
                $img = imagecreatefrompng($file);
                break;
            default:
                Tool::alertBack('类型不符合');
                break;
        }
        return $img;
    }
    public function out() {
        imagepng($this->new, $this->file);
        imagedestroy($this->img);
        imagedestroy($this->new);
    }
}