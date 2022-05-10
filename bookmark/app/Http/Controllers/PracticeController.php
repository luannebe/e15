<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;


class PracticeController extends Controller
{

    /**
     * 
     * GET /practice/18
     * update with a many to many relationship
     */
    public function practice18()
    {

        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        $book = $user->books()->first();

        #notes is the column
        $book->pivot->notes = "new note ...";
        $book->pivot->save();

        return 'Update complete. Check the book_user table to confirm.';

    }
    /**
     * 
     * GET /practice/17
     * delete with a many to many relationship
     */
    public function practice17()
    {

        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        $book = $user->books()->first();

        #delete the relationship
        $book->pivot->delete();

        return 'Delete complete. Check the book_user table to confirm.';

    }
    /**
     * 
     * GET /practice/16
     * many to many and eager loading
     */
    public function practice16()
    {
        # Eager load users to reduce number of queries
        # (Suggestion: Try this without the `with` and watch how it greatly increases the number of queries)
        $books = Book::with('users')->get(); // can't use all() with qualified query

        foreach ($books as $book) {
            if ($book->users->count() == 0) {
                dump($book->title . ' is not on any user’s list');
            } else {
                dump($book->title . ' is on the following user’s lists:');

                foreach ($book->users as $user) {
                    dump($user->email);
                }
            }
        }
    }
    /**
     * 
     * GET /practice/15
     * 
     */
    public function practice15()
    {
        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        dump($user->name . ' has the following books on their list: ');
    
        # Note how we can treat the `books` relationship as a dynamic property ($user->books)
        foreach ($user->books as $book) {
            dump($book->title);
        }
    }

    /**
     * 
     * GET /practice/14
     * Eager loading
     */
    public function practice14(Request $request)
    {
        # Eager load the author with the book
        $books = Book::with('author')->get();

        foreach ($books as $book) {
            if ($book->author) {
                dump($book->author->first_name.' '.$book->author->last_name.' wrote '.$book->title);
            } else {
                dump($book->title. ' has no author associated with it.');
            }
        }
        dump($books->toArray());
    }

    /**
     * 
     * GET /practice/13
     * 
     */
    public function practice13(Request $request)
    {
        # Get an example book
        $book = Book::whereNotNull('author_id')->first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title.' was written by '.$author->first_name.' '.$author->last_name);
        dump($book->toArray());
    }
    /**
     * enter a new book with an author
     * GET /practice/12
     * will produce a string of jason
     */
    public function practice12(Request $request)
    {
        $author = Author::where('first_name', '=', 'J.K.')->first();

        $book = new Book;
        $book->slug = 'fantastic-beasts-and-where-to-find-them';
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2001;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png';
        $book->info_url = 'https://en.wikipedia.org/wiki/Fantastic_Beasts_and_Where_to_Find_Them';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book -- object approach
        $book->description = 'Fantastic Beasts and Where to Find Them is a 2001 guide book written by British author J. K. Rowling (under the pen name of the fictitious author Newt Scamander) about the magical creatures in the Harry Potter universe. The original version, illustrated by the author herself, purports to be Harry Potter’s copy of the textbook of the same name mentioned in Harry Potter and the Philosopher’s Stone (or Harry Potter and the Sorcerer’s Stone in the US), the first novel of the Harry Potter series. It includes several notes inside it supposedly handwritten by Harry, Ron Weasley, and Hermione Granger, detailing their own experiences with some of the beasts described, and including in-jokes relating to the original series.';
        $book->save();
        dump($book->toArray());
    }
    /**
     * get the currently authenticated user
     * GET /practice/11
     * will produce a string of jason
     */
    public function practice11(Request $request)
    {
        # Retrieve the currently authenticated user via the Auth facade
        $user = Auth::user();
        dump($user->toArray());
    
        # Retrieve the currently authenticated user via request object
        $user = $request->user();
        dump($user->toArray());
    
        # Check if the user is logged in
        if (Auth::check()) {
            dump('The user ID is '.Auth::id());
        }
    }

    /**
     * Practice queries
     * GET /practice/10
     * will produce a string of jason
     */
    public function practice10() {
        $books = Book::all();
        echo $books;
    }

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