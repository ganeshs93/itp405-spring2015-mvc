<?php
namespace App\Services;


class RottenTomatoes
{
    public function search($dvd_title)
    {
        $url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json";
        $url .= "?q=" . urlencode($dvd_title);
        $url .= "&page=1&apikey=hb58s3brbbndmeyc8fhfcsse";
        $jsonString = file_get_contents($url);
        $rtData = json_decode($jsonString);
        $movies = $rtData->movies;
        return $movies;
    }
}