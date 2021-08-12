<?php

require "vendor/autoload.php";

use SvNDev\Crawlers\IfoodCrawler;

//$file = (new \SvNDev\Crawlers\IfoodCrawlerFile)->createFileWithAllStatesAndCities();
//
//if ($file) {
//  dd("OK.");
//}

$getRestaurantsByCity = (new IfoodCrawler)->getRestaurants();

file_put_contents("restaurants.txt", json_encode($getRestaurantsByCity));

echo "OK =)";

//json_decode(file_get_contents("restaurants.txt"), true);
