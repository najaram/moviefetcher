<?php

namespace Najaram\MovieFetcher;

interface MovieFetcherInterface
{
  /**
    * Takes a URL pointing to a webpage about a movie (as a string) and returns an value-object instance of
    * MovieInterface containing information about it. If the movie could not be fetched for any reason,
    * it will throw a MovieException.
    *
    * @param string $url
    * @throws \Najaram\MovieFetcher\Exception\MovieException
    * @return \Najaram\MovieFetcher\MovieInterface
    */
  public function fetch($url);
}
