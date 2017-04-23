<?php
header("content-type:text/html; charset=utf-8");
// require 'includes/ValidateCode.class.php';
// $ValidateCode = new ValidateCode();
// $ValidateCode->run();
echo $_POST['content'];
header('content-type:image/png');
$img = imagecreatefrompng('33.jpg');
$imgarr = getimagesize('33.jpg');
list($width, $height, $type) = getimagesize('33.jpg');
$new_width = 100;
$new_height = 50;
if ($width < $height) {
    $new_width = ($new_width / $height) * $width;
} else {
    $new_height = ($new_width / $width) * $height;
}
$new = imagecreatetruecolor($new_width, $new_height);
imagecopyresampled($new, $img, 0, 0, 50, 50, $new_width+50, $new_height+50, $width, $height);
// $color = imagecolorallocate($new, 0, 0, 0);
$mark = imagecreatefrompng('shuiyin.png');
imagecopy($new, $mark, 0, 0, 0, 0, 80, 92);
// imagettftext($new, 10, 0, 25, 70, $color, 'font/Elephant.ttf', 'aiswang.cn');
imagepng($new);
imagedestroy($new);
?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<form method="post">
    <textarea id="TextArea1" class="ckeditor" name="content"></textarea>
    <input type="submit"  value="提交" />
</form>
