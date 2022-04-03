<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class PracticeController extends Controller
{

    /**
     * Practice queries
     * GET /practice/9
     */
    public function practice9() {
        $book = Book::where('author', 'LIKE', '%McCullough%')->first();
        $book->delete();
        dump('Book deleted');

    }

    /**
     * Practice queries
     * GET /practice/8
     */
    public function practice8() {
        $suggestionNumber = 1;
        $hobbies = ['hobby1'];
        $searchResults = [];
        
        foreach ($hobbies as $hobby) {
            array_push($searchResults, $hobby );
        }
        dump($searchResults);

    }
    /**
     * Practice queries
     * GET /practice/7
     */

    public function practice7() {
        # get a book to update
        dump(Book::all()->toArray());

        dump('1. Last Two books created >>');
        dump(Book::orderBy('created_at', 'desc')->limit(2)->get()->toArray());

        dump('2. Books published after 1950 >>');
        dump(Book::where('published_year', '>', 1950)->get()->toArray());

        dump('3. All books in alpha order by title >>');
        dump(Book::orderBy('title')->get()->toArray());

        dump('4. descending order by published year >>');
        dump(Book::orderBy('published_year', 'desc')->get()->toArray());

        dump('5. change JK Rowling to J.K. Rowling >>');
        $books = Book::where('author', '=', 'JK Rowling')->get();
        if(!$books) {
            dump('Book not found, cannot update.');
        } else {
            foreach($books as $book) {
                # change some properties
                $book->author = 'J.K. Rowling';
                # Save the changes
                $book->save();
                dump('Update complete');
            }
        }
        dump(Book::select('author', 'title')->where('author', 'LIKE', '%Rowling%')->get()->toArray());
        
        dump('6. Delete any books that contain "really" in title >>');
        $books = Book::where('title', 'LIKE', 'really')->get();
        if($books->isEmpty()) {
            dump('Book not found, nothing to delete.');
        } else {
            foreach($books as $book) {
                $book->delete();
                dump('Deletion complete');
            }
        }
    }

    /**
     * Update multiple book records
     * GET /practice/6
     */
    public function practice6()
    {
        # get a book to update
        $books = Book::where('author', '=', 'J.K. Rowling')->get();
        if(!$books) {
            dump('Book not found, cannot update.');
        } else {
            foreach($books as $book) {
                # change some properties
                $book->author = 'JK Rowling';
                # Save the changes
                $book->save();
                dump('Update complete');
            }
        }
        dump(Book::orderBy('published_year')->get()->toArray());
    }

    /**
     * Update a book record
     * GET /practice/5
     */
    public function practice5()
    {
        # get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();
        if(!$book) {
            dump('Book not found, cannot update.');
        } else {
            # change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published_year = "2025";
            # Save the changes
            $book->save();
            dump('Update complete');
        }
        dump(Book::orderBy('published_year')->get()->toArray());
    }

    /**
     * Create a book instance in the books table using the Book model
     * GET /practice/4
     */
    public function practice4()
    {
        # Instantiate a new Book Model object
        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->orWhere('published_year', '>', 1998)->select(['title', 'published_year'])->get();
        dump($books->toArray());
    }

    /**
     * Create a book instance in the books table using the Book model
     * GET /practice/3
     */
    public function practice3()
    {
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a column in the table
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author = 'Anthony Weir';
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        # Confirm results
        dump('Added: ' . $book->title);
        dump(Book::all()->toArray());

    }

    public function practice2()
    {
        dump(\DB::select('SHOW DATABASES;'));
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
                'books' => Book::all(),
                'fields' => [
                    'id', 'updated_at', 'created_at', 'slug', 'title', 'author', 'published_year'
                ]
            ]);
        }
    }
}