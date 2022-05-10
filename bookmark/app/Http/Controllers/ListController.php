<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ListController extends Controller
{
    /**
    * GET /list
    */
    public function show(Request $request)
    {
        # Note how in sortByDesc we specify `pivot.created_at` to get 
        # the created_at value for the *relationship*, not the book itself
        $books = $request->user()->books->sortByDesc('pivot.created_at');

        return view('list/show', ['books' => $books]);
    }
    /**
    * GET /list{slug}/add
    */
    public function add(Request $request, $slug)
    {
        $book = Book::findBySlug($slug);
        return view('list/add', ['book' => $book]);
    }

    /**
    * POST /list{slug}/save
    */
    public function save(Request $request, $slug)
    {
       $user = $request->user();
       $book = Book::findBySlug($slug);

       $user->books()->save($book,['notes' => $request->notes]);

       return redirect('/list')->with(['flash-alert' => 'The book '. $book->title . ' was added to your list.'] );
    }

    /**
    * PUT /list{slug}
    * update the notes on the users list
    */
    public function update(Request $request, $slug)
    {
        $book = $request->user()->books()->where('slug', '=', $slug)->first();

        # Update and save the notes for this relationship
        $book->pivot->notes = $request->notes;
        $book->pivot->save();

        #Confirm it worked
        return 'Update complete. Check the `book_user` table to confirm.';

    //    return redirect('#')->with(['flash-alert' => 'The note has been updated.'] );
    }

    /**
    * Deletes the book from the user's list
    * DELETE /list/{slug}/
    */
    public function destroy(Request $request, $slug )
    {
        $book = $request->user()->books()->where('slug', $slug)->first();

        # Delete the (many-to-many) relationship
        $book->pivot->delete();


        return redirect($request->headers->get('referer'))->with([
            'flash-alert' => 'The book ' . $book->title . '” was removed from your list.'
        ]);
    }

}