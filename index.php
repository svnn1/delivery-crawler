<?php

require "vendor/autoload.php";

use SvNDev\Crawlers\IfoodCrawler;

//$states = include "config/locations.php";



//$client = new Client([
//  "base_uri"        => "https://wsloja.ifood.com.br",
//  "headers"         => [
//    "Pragma"             => "no-cache",
//    "Cache-control"      => "no-cache, no-store, max-age=0",
//    "Accept"             => "application/json",
//    "User-Agent"         => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0",
//    "Origin"             => "https://www.ifood.com.br",
//    "Referer"            => "https://www.ifood.com.br",
//    "Accept-Language"    => "pt-BR,pt;q=1",
//  ],
//  "cookies"         => true,
//  "allow_redirects" => true,
//]);
//
//$client2 = new Client([
//  "base_uri"        => "https://www.ifood.com.br/delivery",
//  "headers"         => [
//    "Pragma"          => "no-cache",
//    "Cache-control"   => "no-cache, no-store, max-age=0",
//    "Accept"          => "application/json",
//    "User-Agent"      => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0",
//    "Origin"          => "https://www.ifood.com.br/",
//    "Referer"         => "https://www.ifood.com.br/",
//    "Accept-Language" => "pt-BR,pt;q=1",
//  ],
//  "cookies"         => true,
//  "allow_redirects" => true,
//]);

$states = (new IfoodCrawler)->getRestaurants();

dd($states);

//
//$restaurant = $client2
//  ->get("delivery/guarulhos-sp")
//  ->getBody()
//  ->getContents();

//dd($restaurant);

//$crawler = new Crawler($restaurant);

//dd($crawler);

//->filter("restaurant-name")

//dd($crawler->filter(".restaurant-name")->each(fn($span) => $span->text()));

//foreach ($states as $state) {
//  foreach ($state["cities"] as $index => $city) {
//    if ($state["stateCode"] == $city["stateCode"]) {
//      $cityCode = strtolower($city["stateCode"]);
//      $urlSlug[] = "{$city["name"]}-{$cityCode}";
//    }
//  }
//}

//$listAllRestaurantsCities = [];

//$states = json_decode($client
//  ->get("/ifood-ws-v3/address/states?country=BR")
//  ->getBody()
//  ->getContents(), true);
//
//dd($states);

//foreach ($states["data"]["list"] as $index => $state) {
//  $listAllRestaurantsCities[$index]["state"] = $state["name"];
//  $listAllRestaurantsCities[$index]["stateCode"] = $state["stateCode"];
//
//  $cities = json_decode($client
//    ->get("/ifood-ws-v3/business/cities/{$state['stateCode']}")
//    ->getBody()
//    ->getContents(), true);
//
//  foreach ($cities["data"]["list"] as $index2 => $city) {
//    if (strtolower($state["stateCode"]) === $city["state"]) {
//      $listAllRestaurantsCities[$index]["cities"][$index2]["name"] = ucwords(str_replace("-", " ", $city["name"]));
//      $listAllRestaurantsCities[$index]["cities"][$index2]["stateCode"] = strtoupper($city["state"]);
//      $listAllRestaurantsCities[$index]["cities"][$index2]["slug"] = "{$city["name"]}-{$city["state"]}";
//
//
////      $restaurants = $client2
////        ->get("delivery/{$city['name']}-{$city['state']}")
////        ->getBody()
////        ->getContents();
////
////      foreach ($restaurants as $index3 = $restaurant) {
////        $listAllRestaurantsCities[$index]["cities"][$index2]["restaurants"][$index3]["name"] = $restaurant["name"];
////        $listAllRestaurantsCities[$index]["cities"][$index2]["restaurants"][$index3]["img_url"] = $restaurant["img_url"];
////        $listAllRestaurantsCities[$index]["cities"][$index2]["restaurants"][$index3]["address"] = $restaurant["address"];
////      }
//    }
//  }
//}



//dd($listAllRestaurantsCities);

//file_put_contents('cities.txt', var_export($listAllRestaurantsCities, TRUE));


// Assim que vai ficar os restaurantes...
//$restaurants = [
//  0 => [
//    "name" => "Poderoso Timão",
//    "img_url" => "https://www.todopoderosotimao.com.br/image.png",
//  ],
//];
