<?php
namespace App\Models;

use DB;

class Dvd
{
    public function search($term, $genre, $rating)
    {
        $query = DB::table('dvds')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');
        
        if ($term)
        {
            $query->where('title', 'LIKE', '%' . $term .'%');
        }
        
        if ($genre != 0)
        {
            $query->where('genre_id', '=', $genre);
        }
        
        if ($rating != 0)
        {
            $query->where('rating_id', '=', $rating);
        }
        $query->select('dvds.*', 'ratings.rating_name', 'genres.genre_name', 'labels.label_name', 'sounds.sound_name', 'formats.format_name');
        return $query->get();
    }
    
    public function getAllGenres()
    {
         $query = DB::table('genres');
        return $query->get();
    }
    
    public function getAllRatings()
    {
        $query = DB::table('ratings');
        return $query->get();
    }
    
    public function getGenreName($genre_id)
    {
        $query = DB::table('genres')
            ->where('id', '=', $genre_id)
            ->select('genre_name');
        return $query->first();
    }
    
    public function getRatingName($rating_id)
    {
        $query = DB::table('ratings')
            ->where('id', '=', $rating_id)
            ->select('rating_name');
        return $query->first();
    }
    
    public function getDvdInfo($id)
    {
        $query = DB::table('dvds')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->where('dvds.id' , '=', $id);
        $query->select('dvds.*', 'ratings.rating_name', 'genres.genre_name', 'labels.label_name', 'sounds.sound_name', 'formats.format_name');
        return $query->first();
    }
    
    public function getReviews($id)
    {
        $query = DB::table('reviews')
            ->where('dvd_id', '=', $id);
        return $query->get();
    }
    
    public function addReview($title, $rating, $description, $id)
    {
        DB::table('reviews')->insert([
            'title' => $title,
            'description' => $description,
            'dvd_id' => $id,
            'rating' => $rating
        ]);
    }
}
