<?php

namespace Najaram\MovieFetcher\Parser;

use Symfony\Component\DomCrawler\Crawler;
use Psr\Http\Message\UriInterface;
use Najaram\MovieFetcher\Movie\Movie;

class ImdbParser implements ParserInterface
{
    /**
    * {@inheritDoc}
    */
    public function checkUrl(UriInterface $uriInterface)
    {
        return preg_match('/imdb\.com$/', (string) $uriInterface->getHost());
    }

    /**
    * {@inheritDoc}
    */
    public function crawl(Crawler $html)
    {
        return new Movie(
            $html->filter('#overview-top h1.header .itemprop')->first()->text(),
            (int) $html->filter('#overview-top h1.header span a')->first()->text(),
            (float) $html->filter('#overview-top .star-box-giga-star')->text() * 10,
            $html->filterXPath('//[@id="overview-top"]//a[@itemprop="genre"]')->each(function (Crawler $node, $i) {
                return $node->text();
            }),
            $html->filterXPath('//[@id="overview-top]//p[@itemprop="description"]')->text()
        );
    }
}
