<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Table;
use App\Models\User;
use App\Models\Report;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;


/**
 * The Tracker section of the app is private.
 * Enables authorized inviduals to view and manage reports.
 */

class TrackerController extends Controller
{
    /**
     * GET /tracker
     * Assembles collected reports for display in a table
     */
    public function index(Request $request)
    {
        $reports = Report::orderBy('id', 'DESC')->with('photos')->with('categories')->get();
        $photo = null;

        $count = $reports->count();
        foreach($reports as $report) {
            if ($report->photos->count() > 0 ) {
                $photo = $report->photos->first();
            }
            if ($report->categories->count() > 0) {
                $categories = $report->categories->all();
                //declare an array to hold the categories found
                $arr = array();
                foreach($categories as $category) {
                    array_push($arr, $category->label);
                    $category_list = implode('; ', $arr);
                }
            }
            // format photo as link
            if ($photo) {
                $photo_link = '<a href="' . $photo->url . '">View&nbsp;photo</a>';
                $photo_caption = $photo->caption;
            } else {
                $photo_link = '';
                $photo_caption = '';
            }

            // format links to manage individual reports (in future versions, will include edit link)
            $editor_links = '<a href="/tracker/' . $report->id . '/delete">Delete</a>';

            $rows[] = [ 
                $report->id,
                $report->date_observed,
                $report->street_number . " " . $report->street_name,
                $category_list,
                $report->heritage_tree,
                $report->comments,
                $photo_link,
                $photo_caption,
                $report->observer_email,
                $editor_links,
            ];          
        }
        $titles = [
            'Report Id',
            'Date Observed',
            'Location',
            'Categories',
            'Heritage Tree?',
            'Comments',
            'Photo',
            'Caption',
            'Observer email',
            ''        
        ];

        return view('tracker/index', ['count' => $count, 'titles' => $titles, 'rows' => $rows]);
    }

    /**
     * GET /tracker/{id}/delete
     * Asks user to confirm they want to delete a report
     */
    public function delete($id)
    {
        $report = Report::find($id);

        if(!$report) {
            return redirect('/tracker')->with([
                'flash-alert' => 'Report not found'
            ]);
        }

        return view('tracker/delete', ['report' => $report]);
    }

    /**
     * DELETE /tracker/{id}
     * Deletes single report
     */
    public function destroy($id)
    {
        $report = Report::find($id);

        $report->categories()->detach();

        $photo = Photo::where('report_id', '=', $id);

        if ($photo) {
            $photo->delete();
        }

        $report->delete();

        return redirect('/tracker')->with([
            'flash-alert' => '“Report id ' . $report->id . '” was removed.'
        ]);
    }


}