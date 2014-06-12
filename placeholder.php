<?php
require 'goutte.phar';
use Goutte\Client;

if (isset($_GET['t']) && $_GET['t']=="image") {
	$type = "image";
} else {
	$type = "text";
}

if (isset($_GET['w']) && is_numeric($_GET['w'])) {
    $width = $_GET['w'];
} else {
    $width = 200;
}

if (isset($_GET['h']) && is_numeric($_GET['h'])) {
    $height = $_GET['h'];
} else {
    $height = 200;
}

if ($type == "image") {
	$url = 'http://commons.wikimedia.org/wiki/Special:Random/File';

	$client = new Client();
	$crawler = $client->request('GET', $url);

	$status_code = $client->getResponse()->getStatus();
	if($status_code==200){
	    //echo "<pre>";
	    if (!extension_loaded('imagick')) {
	    	echo 'ImageMagick not installed';
	    	exit();
	    }
	    $image = new Imagick($crawler->filter('div.fullMedia > a')->first()->link()->getUri());
	    $image->scaleImage($width, $height);
	}

} else {
	$image = new Imagick();
	$draw = new ImagickDraw();
	$pixel = new ImagickPixel('black');

	/* New image */
	$image->newImage($width, $height, $pixel);

	/* White text */
	$draw->setFillColor('white');

	/* Font properties */
	$draw->setFontSize(50);

	/* Create text */
	$draw->setTextAlignment(2);
	$draw->annotation($width/2, $height/2, $width."x".$height);
	$image->drawImage($draw);

	/* Give image a format */
	$image->setImageFormat('png');
}

header("Content-Type: image/png");
echo $image;
?>