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
}