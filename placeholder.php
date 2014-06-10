<?php
require_once 'goutte.phar';
use Goutte\Client;

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

$url = 'http://commons.wikimedia.org/wiki/Special:Random/File';

$client = new Client();
$crawler = $client->request('GET', $url);

$status_code = $client->getResponse()->getStatus();
if($status_code==200){
    //echo "<pre>";
    $images = new Imagick($crawler->filter('div.fullMedia > a')->first()->link()->getUri());
    $images->scaleImage($width, $height);
    header("Content-Type: image/png");
    echo $images;
}
?>