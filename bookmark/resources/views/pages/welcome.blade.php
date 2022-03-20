@extends('layouts/main')
 
@section('content')
<p>
    Welcome to Bookmark&mdash; an online book journal that lets you track and share a history of books you’ve read.
</p>

<form method='GET' action='/search'>

    <h2>Search for a book to add to your list</h2>

    <fieldset>
        <label for='searchTerms'>
            Search terms:
            <input type='text' name='searchTerms' value='{{$searchTerms}}'>
        </label>
    </fieldset>

    <fieldset>
        <label>
            Search type:
        </label>

        <input 
            type='radio' 
            name='searchType' 
            id='title' 
            value='title'
            {{($searchType == 'title' || is_null($searchType) ? 'checked' : '')}}
        >
        <label for='title'> Title</label>
        
        <input 
            type='radio' 
            name='searchType' 
            id='author' 
            value='author' 
            {{($searchType == 'author' ? 'checked' : '')}}
        >
        <label for='author'> Author</label>
        
    </fieldset>

    <button type='submit' class='btn btn-primary'>Search</button>

</form>
@if(!is_null($searchResults))
    @if(count($searchResults) == 0)
        <div class='results alert alert-warning'>
            No results found.
        </div>
    @else
        <div class='results alert alert-primary'>

           {{ count($searchResults) }} 
           {{ Str::plural('Result', count($searchResults)) }}:

            <ul class='clean-list'>
                @foreach($searchResults as $slug => $book)
                <li><a href='/books/{{ $slug }}'> {{ $book['title'] }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
@endsection