<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Report;

class PracticeController extends Controller
{
    /**
     * First practice example
     * GET /practice/3
     */
    public function practice3()
    {
        $report = new Report();
        $report->street_number = '2000';
        $report->street_name = 'Massachusetts Ave. NW';
        $report->date_observed = '2021-05-16';
        $report->time_observed = '12:43:00';
        $report->heritage_tree = 1;
        $report->comments = 'Milani tall equipment uses the lane as a parking area. The high equipment has broken branches of important elm and linden trees that RMA and local owners have nurtured for years. Trees could be ruined.';
        $report->observer_first_name = "Deborah";
        $report->observer_last_name = "Shapley";
        $report->observer_email = "restoremassave@gmail.com";
        $report->save();

        dump('Added: ' . $report->id); 
        dump(Report::all()->toARray());
    }

    /**
     * First practice example
     * GET /practice/2
     */
    public function practice2()
    {
        dump(DB::select('SHOW DATABASES;'));
    }

    /**
     * First practice example
     * GET /practice/1
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://bookmark.yourdomain.com.loc/practice => Shows a listing of all practice routes
     * http://bookmark.yourdomain.com.loc/practice/1 => Invokes practice1
     * http://bookmark.yourdomain.com.loc/practice/5 => Invokes practice5
     * http://bookmark.yourdomain.com.loc/practice/999 => 404 not found
     */
    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with([
                'methods' => $methods,
            ]);
        }
    }
}