<?php
//session_start();

$string = '';

for ($i = 0; $i < 5; $i++) {
	$string .= chr(rand(97, 122));
}

$_SESSION['random_number'] = $string;

$dir = 'assets/templates/investable/fonts/';

$image = imagecreatetruecolor(165, 50);

// random number 1 or 2
$num = rand(1,2);
if($num==1)
{
	$font = "calvert-mt.ttf"; // font style
}
else
{
	$font = "calvert-mt.ttf";// font style
}

// random number 1 or 2
$num2 = rand(1,2);
if($num2==1)
{
	$color = imagecolorallocate($image, 32, 182, 174);// color
}
else
{
	$color = imagecolorallocate($image, 243, 107, 34);// color
}

$white = imagecolorallocate($image, 255, 255, 255); // background color white
imagefilledrectangle($image,0,0,399,99,$white);

imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['random_number']);

header("Content-type: image/png");
imagepng($image);

?>