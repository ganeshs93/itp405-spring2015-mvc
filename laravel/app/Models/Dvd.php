<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Dvd extends Model
{
    protected $table = 'dvds';
    
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
        return Genres::all();
    }
    
    public function getAllRatings()
    {
        return Ratings::all();
    }
    
    public function getAllLabels()
    {
        return Labels::all();   
    }
    
    public function getAllSounds()
    {
        return Sounds::all();   
    }
    
    public function getAllFormats()
    {
        return Formats::all();   
    }
    
    
    public function getDvdsByGenreName($genreName)
    {
        $dvds = self::with('ratings', 'genres', 'labels')
            ->whereHas('genres', function($query) use($genreName)
            {
                $query->where('genre_name', '=', $genreName);
            })
            ->get();
        return $dvds;
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
    
    public function labels()
    {
        return $this->belongsTo('App\Models\Labels', 'label_id');
    }
    
    public function sounds()
    {
        return $this->belongsTo('App\Models\Sounds', 'sound_id');
    }
    
    public function genres()
    {
        return $this->belongsTo('App\Models\Genres', 'genre_id');
    }
    
    public function ratings()
    {
        return $this->belongsTo('App\Models\Ratings', 'rating_id');
    }
    
    public function formats()
    {
        return $this->belongsTo('App\Models\Formats', 'format_id');
    }
}
