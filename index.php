<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim(array('debug'=>true));

$app->get('/:width/:height', 'fromText');

$app->response->headers->set('Content-Type', 'image/png');
$app->run();

function fromWikiCommons($width, $height) {
#	use Goutte\Client;
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
	echo $image;
}

function fromText($width, $height) {
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

	echo $image;
}


?>
