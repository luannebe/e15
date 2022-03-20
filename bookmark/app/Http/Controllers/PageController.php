<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * GET /
     */
    public function welcome() {
        $searchResults = session('searchResults',  null);
        $searchTerms = session('searchTerms',  null);
        $searchType = session('searchType',  null);

        return view('pages/welcome', [
            'searchResults' => $searchResults, 
            'searchTerms' => $searchTerms, 
            'searchType' => $searchType
        ]);
    }

    public function contact()
    {
        return view('pages/contact');
    }
}