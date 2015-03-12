<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Dvd;

class DvdController extends Controller
{
    public function search()
    {
        $query = new Dvd();
        $genres = $query->getAllGenres();
        $ratings = $query->getAllRatings();
        //dd($genres);
        //dd($ratings);
        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }
    
    public function results(Request $request)
    {
        $query = new Dvd();
        $dvds = $query->search($request->input('dvd_title'), $request->input('genre_id'), $request->input('rating_id'));
        $genre = 'All';
        $rating = 'All';
        if ($request->input('genre_id') != 0)
            $genre = $query->getGenreName($request->input('genre_id'))->genre_name;
        if ($request->input('rating_id') != 0)
            $rating = $query->getRatingName($request->input('rating_id'))->rating_name;
        //var_dump($request->input('dvd_title'));
        //var_dump($genre);
        //var_dump($rating);
        //dd($dvds);
        return view('results', [
            'search_term' => $request->input('dvd_title'),
            'genre_chosen' => $genre,
            'rating_chosen' => $rating,
            'dvds' => $dvds
        ]);
    } 
    
    public function showDetails($id)
    {
        $query = new Dvd();
        $dvd = $query->getDvdInfo($id);
        $reviews = $query->getReviews($id);
        return view('reviews', [
            'dvd' => $dvd,
            'reviews' => $reviews
        ]);
    }
    
    public function submitReview($id, Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'title' => 'required|min:5',
            'rating' => 'required|numeric|between:1,10',
            'review' => 'required|min:20'
        ]);
        if($validation->passes())
        {
            $query = new Dvd();
            $query->addReview($request->input('title'), $request->input('rating'), $request->input('review'), $id);
            return redirect('dvds/'.$id)->with('success', 'Review successfully submitted');
        }
        else
        {
            return redirect('dvds/'.$id)
                ->withInput()
                ->withErrors($validation);
        }
    }
    
    public function createDvd()
    {
        $model = new Dvd();
        $labels = $model->getAllLabels();
        $sounds = $model->getAllSounds();
        $formats = $model->getAllFormats();
        $genres = $model->getAllGenres();
        $ratings = $model->getAllRatings();
        return view('createDvd', [
            'labels' => $labels,
            'sounds' => $sounds,
            'formats' => $formats,
            'genres' => $genres,
            'ratings' => $ratings
        ]);   
    }
    
    public function submitNewDvd(Request $request)
    {
        $dvd = new Dvd();
        $dvd->title = $request->input('dvd_title');
        $dvd->label_id = $request->input('label_id');
        $dvd->sound_id = $request->input('sound_id');
        $dvd->genre_id = $request->input('genre_id');
        $dvd->rating_id = $request->input('rating_id');
        $dvd->format_id = $request->input('format_id');
        $dvd->save();
        return redirect('/dvds/create')->with('success', 'Dvd successfully submitted');   
    }
    
    public function dvdsByGenre($genreName)
    {
        $model = new Dvd();
        $dvds = $model->getDvdsByGenreName($genreName);
        return view('dvdsByGenre', [
            'dvds' => $dvds,
            'genreName' => $genreName
        ]);
    }
}