<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieSearchRequest;
use App\Http\Requests\AddFavoriteRequest;
use Illuminate\Support\Facades\Http;
use App\Models\FavoriteMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function search(MovieSearchRequest $request)
    {
        $response = Http::get("http://www.omdbapi.com/", [
            'apikey' => env('OMDB_API_KEY'),
            't' => $request->title
        ]);

        return $response->json();
    }

    public function addFavorite(AddFavoriteRequest $request)
    {
        $movie = FavoriteMovie::create([
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'movie_title' => $request->movie_title,
            'poster_url' => $request->poster_url
        ]);

        return response()->json(['message' => 'Movie added to favorites', 'movie' => $movie]);
    }

    public function getFavorites()
    {
        return response()->json(auth()->user()->favoriteMovies);
    }
    

    public function removeFavorite($id) {
        $movie = FavoriteMovie::where('id', $id)->where('user_id', Auth::id())->first();
        if ($movie) {
            $movie->delete();
            return back()->with('message', 'Movie removed from favorites');
        }
        return back()->with('error', 'Movie not found');
    }
}
