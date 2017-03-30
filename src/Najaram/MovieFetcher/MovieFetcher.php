<?php

namespace Najaram\MovieFetcher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use Najaram\MovieFetcher\Parser\ParserInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;
use League\Uri\Schemes\Http;

class MovieFetcher implements MovieFetcherInterface
{
  /**
   * \GuzzleHttp\ClientInterface
   */
  protected $client;

  /**
   * \Symfony\Component\DomCrawler\Crawler
   */
  protected $crawler;

  /**
   * \Najaram\MovieFetcher\Parser\ParserInterface
   */
  protected $parser;

  public function __construct(ClientInterface $client, Crawler $crawler, ParserInterface $parser)
  {
    $this->client = $client;
    $this->crawler = $crawler;
    $this->parser = $parser;
  }

  public function fetch($url)
  {
    $url = Http::createFromString($url);

    if (!($this->parser instanceof ParserInterface)) {
      throw new \Exception('Must be a Parse Interface object.');
    }
    
    if ($this->parser->checkUrl($url)) {
      $document = $this->getUrl($url);
      return $this->parser->crawl($document);
    }
  }

  /**
   * @param Psr\Http\Message\UriInterface
   */
  protected function getUrl(UriInterface $url)
  {
    $request = new Request('GET', (string) $url, []);
    $response = $this->client->send($request);
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
    if ($response->getStatusCode() == 200) {

      $crawler = $this->crawler ?: new Crawler();
      $crawler->clear();
      $crawler->addHtmlContent((string) $response->getBody());

      return $crawler;
    }
  }
}
