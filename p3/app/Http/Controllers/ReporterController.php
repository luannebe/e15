<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Report;
use App\Models\Category;
use App\Models\Photo;
use App\Mail\NewReportNotification;
use Illuminate\Support\Facades\Mail;

/**
 * The Reporter section of the app is public.
 * Enables anyone to submit a report
 */

class ReporterController extends Controller
{

    /**
     * GET /
     * Public home page
     */
    public function welcome() {
        return view('reporter/welcome');
    }
    /**
     * GET /make-a-report
     * Display the public form to make an observer report
     */
    public function create() {
       // get the form inputs, if any, from session
        $date_observed = session('date_observed');
        $street_number = session('street_number');
        $street_name = session('street_name');
        $categories = session('categories');
        $filename = session('filename');
        $caption = session('caption'); 
        $heritage_tree = session('heritage_tree');
        $comments = session('comments');
        $observer_first_name = session('observer_first_name'); 
        $observer_last_name = session('observer_last_name'); 
        $observer_email = session('observer_email');   

        return view('reporter/create', [
            'date_observed' => $date_observed,
            'street_number' => $street_number,
            'street_name' => $street_name,
            'categories' => $categories,
            'filename' => $filename,
            'caption' => $caption,
            'heritage_tree' => $heritage_tree,
            'comments' => $comments,
            'observer_first_name' => $observer_first_name, 
            'observer_last_name' => $observer_last_name, 
            'observer_email' => $observer_email,             
        ]);
    }

    /**
     * POST /make-a-report
     * Process the form for adding a new observer report
     */
    public function store(Request $request) {
        $request->validate([
            'date_observed' => 'required|date',
            'street_number' => 'required|max:255',
            'street_name' => 'required|max:255', 
            'categories' => 'required',     
            'observer_first_name' => 'required|max:255',
            'observer_last_name' => 'required|max:255',
            'observer_email' => 'required|email',
            'filename' => 'image|mimes:jpeg,bmp,png|max:8000',
        ]);

        $report = new Report();
        $report->date_observed = $request->date_observed;
        $report->street_number = $request->street_number;
        $report->street_name = $request->street_name;
        $report->heritage_tree = $request->heritage_tree;
        $report->comments = $request->comments;
        $report->observer_first_name = $request->observer_first_name;
        $report->observer_last_name = $request->observer_last_name;
        $report->observer_email = $request->observer_email;
        $report->save();

        // Save report and categories in the pivot table
        $categoryArray = $request->categories;
        foreach ($categoryArray as $categoryId ) {
            $category = Category::where('id', '=', $categoryId)->first();
            $report->categories()->save($category);
        }
        $photo = null;
        // Save photo filename and caption in photos table
        // Note: in future versions of app, one report will have up to three photos
        if ($request->filename) {
            $photo = new Photo();
            $file = $request->filename;
            $location = str_replace(" ", "-", $request->street_number) . "-" . str_replace(" ", "-", $request->street_name);
            $newfilename = $request->date_observed . "_" . $location. "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $newfilename);
            $photo->filename =  $newfilename;
            $photo->caption = $request->caption;
            $photo->report()->associate($report);
            //storing urls this way bad design choice; do not store this way in future
            $photo->url = "http://e15p3.flyingdog.nu/uploads/" . $newfilename;
            $photo->save();
        }
        
        // send notification email

        Mail::to('lu@flyingdog.nu')->send(new NewReportNotification($report, $photo));

        return redirect('/make-a-report')->with(['flash-alert' => 'Your report was submitted. Thank you for helping us save trees!']);
    }
}