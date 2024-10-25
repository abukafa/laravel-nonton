<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $featuredMovies = Movie::whereIsFeatured(true)->get();
        // $movies = Movie::all();
        // return inertia('User/Dashboard/Index', [
        //     'featuredMovies' => $featuredMovies,
        //     'movies' => $movies,
        // ]);

        $searchTerm = $request->input('search', '');
        $moviesQuery = Movie::query();

        if ($searchTerm) {
            $moviesQuery->where('name', 'like', '%' . $searchTerm . '%');
        }

        $featuredMovies = Movie::whereIsFeatured(true)->get();
        $movies = $moviesQuery->orderBy('id', 'desc')->get();

        return inertia('User/Dashboard/Index', [
            'featuredMovies' => $featuredMovies,
            'movies' => $movies,
            'searchTerm' => $searchTerm,
        ]);
    }
}
