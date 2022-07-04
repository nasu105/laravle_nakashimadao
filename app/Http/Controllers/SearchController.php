<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Searchable\Search;
use App\Models\Question;

class SearchController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    // public function searchresult( Request $request)
    // {
    //   $searchResults = Spatie\Searchable\Search::(new Search())
    //     ->registerModel(Question::class, 'discription')
    //     ->perform($request->input('query'));
        
    //     return view('search.result', compact('searchResults'));
    // }
}
