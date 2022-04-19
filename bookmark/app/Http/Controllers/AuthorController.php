<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;


class AuthorController extends Controller
{
    /**
    * GET /authors/create
    * Display the form to add a new author
    */
    public function create(Request $request)
    {
        return view('authors/create');
    }

    /**
    * POST /authors
    * Process the form for adding a new author
    */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'birth_year' => 'required|digits:4',
            'bio_url' => 'required|url',
        ]);

        $author = new Author();
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->birth_year = $request->birth_year;
        $author->bio_url = $request->bio_url;
        $author->save();
        //confirm
        // dump($book);

        return redirect('/authors/create')->with(['flash-alert' => 'Your author was added']);
    }

     /**
    * GET /author/{id}/edit
    * Display the form for editing an author
    */
    public function edit(Request $request, $id)
    {
        $author = Book::where('author_id', '=', $id)->first();

        if (!$author) {
            return redirect('/authors')->with(['flash-alert' => 'Author not found.']);
        }

        return view('authors/edit', [
            'author' => $author,
        ]);
    }

    /**
    * PUT /authors
    * Process the form for updating an existing author
    */
    public function update(Request $request, $id)
    {
        $author = Book::where('author_id', '=', $id)->first();

        if(!$author) {
            return redirect('/author')->with(['flash=alert' => 'Author not found']);
        }
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'birth_year' => 'required|digits:4',
            'bio_url' => 'required|url',
        ]);

        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->birth_year = $request->birth_year;
        $author->bio_url = $request->bio_url;
        $author->save();
        //confirm
        // dump($book);

        return redirect('/authors/'. $id .'/edit')->with(['flash-alert' => 'Your changes were saved']);
    }
}