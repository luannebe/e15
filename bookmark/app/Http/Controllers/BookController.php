<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Author;
use App\Models\Book;


class BookController extends Controller
{
    /**
    * GET /books/create
    * Display the form to add a new book
    */
    public function create(Request $request)
    {
        # Get data for authors in alphabetical order by last name
        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();
        return view('books/create', ['authors' => $authors]);
    }

    /**
    * POST /books
    * Process the form for adding a new book
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            //unique slug in books
            'slug' => 'required|unique:books,slug,alpha_dash',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'required|url',
            'info_url' => 'required|url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:100'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();
        //confirm
        // dump($book);

        return redirect('/books/create')->with(['flash-alert' => 'Your book was added']);
    }

   /**
    * GET /books/{slug}/edit
    * Display the form for editing a book
    */
    public function edit(Request $request, $slug)
    {
        $book = Book::with('author')->where('slug', '=', $slug)->first();

        # Get data for authors in alphabetical order by last name
        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();

        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        }

        return view('books/edit', [
            'book' => $book,
            'authors' => $authors
        ]);
    }

    /**
    * PUT /books
    * Process the form for updating an existing book
    */
    public function update(Request $request, $slug)
    {
        $book = Book::with('author')->where('slug', '=', $slug)->first();

        if(!$book) {
            return redirect('/books')->with(['flash=alert' => 'Book not found']);
        }
        $request->validate([
            'title' => 'required|max:255',
            //exclude the id of the row being edited
            'slug' => 'required|unique:books,slug,' .  $book->id . 'alpha_dash',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'required|url',
            'info_url' => 'required|url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:100'
        ]);

        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();
        //confirm
        // dump($book);

        return redirect('/books/'. $slug .'/edit')->with(['flash-alert' => 'Your changes were saved']);
    }

    /**
     * GET /search
     * get books based on search term and Title or Author
     */
    public function search(Request $request){
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # Note: If validation fails, it will redirect back to `/`

        # Get form data
        $searchType = $request->input('searchType', 'title');
        $searchTerms = $request->input('searchTerms', '');

        # Do the search
        $searchResults = Book::where($searchType, 'LIKE', '%'.$searchTerms.'%')->get();

        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/responses#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchTerms' => $searchTerms,
            'searchType' => $searchType,
            'searchResults' => $searchResults
        ]);

        // $bookData = file_get_contents(database_path('books.json'));
        // $books = json_decode($bookData, true);

        // $searchType = $request->input('searchType', 'title');
        // $searchTerms = $request->input('searchTerms', '');

        // $searchResults = [];

        // foreach ($books as $slug => $book) {
        //     if (strtolower($book[$searchType]) == strtolower($searchTerms)) {
        //         $searchResults[$slug] = $book;
        //     }
        // }
        // // not sure point of that below
        // //to persist the data
        // //session(['searchResults' => $searchResults]);

        // return redirect('/')->with([
        //     'searchResults' => $searchResults,
        //     'searchTerms' => $searchTerms,
        //     'searchType' => $searchType
        // ]);
    }

    public function index()
    {
        # Load book data using PHP’s file_get_contents
        # We specify the books.json file path using Laravel’s database_path helper
        // $bookData = file_get_contents(database_path('books.json'));

        # Convert the string of JSON text loaded from books.json into an
        # array using PHP’s built-in json_decode function
        # true converts to array (rather than object)
       // $books = json_decode($bookData, true);

        # Alphabetize the books by title using Laravel’s Arr::sort
        //$books = Arr::sort($books, function ($value) {
        //    return $value['title'];
        //});

        // return view('books/index', ['books' => $books]);

        ## NEW VERSION for use with database
        ## query to get all the books, put into collection
        $books = Book::orderBy('title', 'ASC')->get();
        ## take the 3 most recent
        $newBooks = $books->sortByDesc('id')->take(3);
        return view('books/index', ['books' => $books, 'newBooks' => $newBooks]);
    }

    /**
     * GET /books/{slug}
     * Show the details for an individual book
     */

    public function show($slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('books/show', [
            'book' => $book,
        ]);
        # Load book data
        # @TODO: This code is redundant with loading the books in the index method
        // $bookData = file_get_contents(database_path('books.json'));
        // $books = json_decode($bookData, true);

        # Narrow down array of books to the single book we’re loading
        // $book = Arr::first($books, function ($value, $key) use ($slug) {
        //     return $key == $slug;
        // });

        // return view('books/show', [
        //     'book' => $book,
        // ]);

    }



     /**
    * Asks user to confirm they want to delete the book
    * GET /books/{slug}/delete
    */
    public function delete($slug)
    {
        $book = Book::findBySlug($slug);

        if (!$book) {
            return redirect('/books')->with([
                'flash-alert' => 'Book not found'
            ]);
        }

        return view('books/delete', ['book' => $book]);
    }

    /**
    * Deletes the book
    * DELETE /books/{slug}/delete
    */
    public function destroy($slug)
    {
        $book = Book::findBySlug($slug);

        #$book->users()->detach();

        $book->delete();

        return redirect('/books')->with([
            'flash-alert' => '“' . $book->title . '” was removed.'
        ]);
    }

    public function filter($category, $subcategory)
    {
        return 'Show all books in these categories: ' . $category . ' , ' . $subcategory;
    }
}