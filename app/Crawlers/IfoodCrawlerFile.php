<?php

namespace SvNDev\Crawlers;

use GuzzleHttp\Client;
use SvNDev\Support\Helpers;

class IfoodCrawlerFile
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
      "base_uri"        => "https://wsloja.ifood.com.br",
      "headers"         => [
        "Pragma"          => "no-cache",
        "Cache-control"   => "no-cache, no-store, max-age=0",
        "Accept"          => "application/json",
        "User-Agent"      => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0",
        "Origin"          => "https://www.ifood.com.br",
        "Referer"         => "https://www.ifood.com.br",
        "Accept-Language" => "pt-BR,pt;q=1",
        "access_key"         => "69f181d5-0046-4221-b7b2-deef62bd60d5",
        "secret_key"         => "9ef4fb4f-7a1d-4e0d-a9b1-9b82873297d8",
        "X-Ifood-Session-Id" => "eb086a94-76e1-4f01-964c-4945e3b7e610",
      ],
      "cookies"         => true,
      "allow_redirects" => true,
    ]);
  }

  /**
   * @return bool
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function createFileWithAllStatesAndCities(): bool
  {
    $states = $this->getStates();
    $file = [];

    foreach ($states["data"]["list"] as $index => $state) {
      $file[$index]["state"] = $state["name"];
      $file[$index]["stateCode"] = $state["stateCode"];

      $cities = $this->getCities($state['stateCode']);

      foreach ($cities["data"]["list"] as $index2 => $city) {
        if (strtolower($state["stateCode"]) === $city["state"]) {
          $file[$index]["cities"][$index2]["name"] = ucwords(str_replace("-", " ", $city["name"]));
          $file[$index]["cities"][$index2]["stateCode"] = strtoupper($city["state"]);
          $file[$index]["cities"][$index2]["slug"] = "{$city["name"]}-{$city["state"]}";
        }
      }
    }

    file_put_contents(Helpers::getConfigPath('data.txt'), json_encode($file));

    return true;
  }

  /**
   * @return mixed
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  private function getStates(): mixed
  {
    return json_decode($this->client
      ->get("/ifood-ws-v3/address/states?country=BR")
      ->getBody()
      ->getContents(), true);
  }

  /**
   * @param $stateCode
   *
   * @return mixed
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  private function getCities($stateCode): mixed
  {
    return json_decode($this->client
      ->get("/ifood-ws-v3/business/cities/$stateCode")
      ->getBody()
      ->getContents(), true);
  }
}