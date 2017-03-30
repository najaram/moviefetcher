<?php

namespace Najaram\MovieFetcher\Movie;

use Najaram\MovieFetcher\Movie\MovieInterface;

class Movie implements MovieInterface, \JsonSerializable
{

    /**
    * @var string
    */
    protected $title;

    /**
    * @var integer
    */
    protected $yearOfRelease;

    /**
    * @var float 
    */
    protected $rating;

    /**
    * @var array
    */
    protected $genres;

    /**
    * @var string
    */
    protected $summary;

    public function __construct($title, $yearOfRelease, $rating, $genres, $summary)
    {
        $this->title = $title;
        $this->yearOfRelease = $yearOfRelease;
        $this->rating = $rating;
        $this->genres = $genres;
        $this->summary = $summary;
    }

    /**
    * @return string
    */
    public function getTitle()
    {
        return $this->title;
    }

    /**
    * @return integer
    */
    public function getYearOfRelease()
    {
        return $this->yearOfRelease;
    }

    /**
    * @return float
    */
    public function getRating()
    {
        return $this->rating;
    }

    /**
    * @return array
    */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
    * @return string
    */
    public function getSummary()
    {
        return $this->summary;
    }

    public function jsonSerialize()
    {
        return json_encode([
            'title' => $this->getTitle(),
            'yearOfRelease' => $this->getYearOfRelease(),
            'rating' => $this->getRating(    ),
            'genres' => $this->getGenres(),
            'summary' => $this->getSummary(),
        ]);
    }
}
