<?php

namespace Najaram\MovieFetcher\Parser;

use Symfony\Component\DomCrawler\Crawler;
use Psr\Http\Message\UriInterface;

interface ParserInterface
{
  /**
   * @param string $url
   * @return boolean
   */
  public function checkUrl(UriInterface $uriInterface);

  /**
   * @param Crawler
   * @return MovieInterface
   */
  public function crawl(Crawler $html);
}
