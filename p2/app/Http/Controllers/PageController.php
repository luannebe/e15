<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PageController extends Controller
{
    /**
     * GET /
     * Displays the main page (in this project, the only page)
     */
    public function welcome() {
        // get the form inputs, if any, from session
        $question = session('question', null);
        $headsMeans = session('headsMeans', 'Yes');
        $numTosses = session('numTosses',  '1');
        // and the process results
        $tossResults = session('tossResults',  null);
        $decision = session('decision',  null);

        return view('pages/welcome', [
            'question' => $question, 
            'headsMeans' => $headsMeans, 
            'numTosses' => $numTosses,
            'tossResults' => $tossResults,
            'decision' => $decision
        ]);

    }

    /**
     * GET /process
     * process the coin's decisions 
     */
    public function process(Request $request) {

        $request->validate([
            'question' => 'required',
            'headsMeans' => 'required',
            'numTosses' => 'required|in:1,3,5'
        ]);

        $question = $request->input('question', '');
        $headsMeans = $request->input('headsMeans', 'Yes');
        $numTosses = $request->input('numTosses', '1');

        $tossResults = [];
        $headsCount = $tailsCount = 0;
        $decision;

        $tailsMeans = ($headsMeans == 'Yes') ? 'No' : 'Yes';

        // do stuff with the info
        // for each toss get a random number between 3 and 10
        // and put into an array
        // count the number of heads and tails
        // set decision to yes or no

        for ($i = 1; $i <= $numTosses; $i++) {
            $tossResults[$i]  = rand(3, 10);
            if ($tossResults[$i] % 2 == 0) {
                $headsCount++; 
            }  else {
                $tailsCount++;
            }
            $decision = ( $headsCount > $tailsCount) ? $headsMeans : $tailsMeans;
        }
        // redirect back to the form, with data
        return redirect('/')->with([
            'question' => $question, 
            'headsMeans' => $headsMeans, 
            'numTosses' => $numTosses,
            'tossResults' => $tossResults,
            'decision' => $decision
        ]);

    }
}