<?php

namespace SvNDev\Crawlers;

use GuzzleHttp\Client;

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

  public function getRestaurants($city): array
  {
    $this->createSlug($city);

    return [];
  }

  public function getCity(string $city): array
  {
    return json_decode($this->instanceClient()
      ->get("/ifood-ws-v3/business/cities/{$state['stateCode']}")
      ->getBody()
      ->getContents(), true);
  }

  private function createSlug(string $str, string $delimiter = "-"): string
  {
    return strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
  }

  private function instanceClient(): Client
  {
    return new Client([
      "base_uri"        => "https://wsloja.ifood.com.br",
      "headers"         => [
        "Pragma"             => "no-cache",
        "Cache-control"      => "no-cache, no-store, max-age=0",
        "Accept"             => "application/json",
        "User-Agent"         => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0",
        "Origin"             => "https://www.ifood.com.br/",
        "Referer"            => "https://www.ifood.com.br/",
        "Accept-Language"    => "pt-BR,pt;q=1",
        "access_key"         => "69f181d5-0046-4221-b7b2-deef62bd60d5",
        "secret_key"         => "9ef4fb4f-7a1d-4e0d-a9b1-9b82873297d8",
        "X-Ifood-Session-Id" => "eb086a94-76e1-4f01-964c-4945e3b7e610",
      ],
      "cookies"         => true,
      "allow_redirects" => true,
    ]);
  }
}