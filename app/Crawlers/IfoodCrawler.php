<?php

namespace SvNDev\Crawlers;

use GuzzleHttp\Client;
use SvNDev\Support\Helpers;
use Symfony\Component\DomCrawler\Crawler;

class IfoodCrawler
{
  /**
   * @var \GuzzleHttp\Client
   */
  protected Client $client;

  public function __construct()
  {
    $this->client = $this->instanceClient();
  }

  private function instanceClient(): Client
  {
    return new Client([
      "base_uri"        => "https://www.ifood.com.br/delivery",
      "headers"         => [
        "Pragma"          => "no-cache",
        "Cache-control"   => "no-cache, no-store, max-age=0",
        "Accept"          => "application/json",
        "User-Agent"      => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0",
        "Origin"          => "https://www.ifood.com.br/",
        "Referer"         => "https://www.ifood.com.br/",
        "Accept-Language" => "pt-BR,pt;q=1",
      ],
      "cookies"         => true,
      "allow_redirects" => true,
    ]);
  }

  private function getNodeSelectorText(mixed $node, string $selector): array
  {
    return (new Crawler($node))->filter($selector)->each(fn($span) => $span->text());
  }

  public function getRestaurants(): array
  {
    $states = $this->getLocations();
    $restaurants = [];

    foreach ($states as $state) {
      foreach ($state["cities"] as $city) {
        $cityName = ucwords(str_replace("-", " ", $city["name"]));
        $body = $this->client->get("delivery/{$city['slug']}")->getBody()->getContents();

        $restaurants[$state["state"]][$cityName] = $this->getNodeSelectorText(
          $body,
          ".restaurant-name"
        );
      }
    }

    return $restaurants;
  }

  private function getLocations()
  {
    return include Helpers::getConfigPath("locations.php");
  }
}