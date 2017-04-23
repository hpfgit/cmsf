<?php
$imgarr = getimagesize('33.jpg');
list($width, $height, $type) = getimagesize('33.jpg');
print_r($imgarr);
echo $width.'<br>';
echo $height.'<br>';
echo $type;
?>
