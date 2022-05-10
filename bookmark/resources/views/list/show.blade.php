@extends('layouts/main')

@section('title')
Your List
@endsection

@section('content')

<h1>Your List</h1>
@if($books->count() == 0)
    <p>You have not added any books to your list yet.</p>
    <p><a href='/books'>Find books to add in our library...</a></p>
@else

    @foreach($books as $book)
        <div class='book'>
            <a href='/books/{{ $book->slug }}'>
                <h2>{{ $book->title }}</h2>
            </a>

            @if($book->author)
            <p>By {{ $book->author->first_name. ' ' . $book->author->last_name }}</p>
            @endif

            {{-- TODo: finish the update note feature --}}
            {{-- In the following two paragraphs, observe how `$book->pivot` is used to access 
            details (`created_at` and `notes`) from the book to user relationship --}}
            <form method="POST" action='/list/{{ $book->slug }}'>
                {{ csrf_field() }}
                {{ method_field('put')}}          

                <textarea name="notes">{{ $book->pivot->notes }}</textarea>
                <input type='submit' class='btn btn-primary' value='Update notes'>
            </form>

            <p class='added'>
                Added {{ $book->pivot->created_at->diffForHumans() }}
            </p>

            <a href="/list/{{ $book->slug }}"><i class="fa fa-minus-circle"></i> Remove from your list</a>

                        {{-- TODo: finish the delete note feature --}}
        </div>
    @endforeach

@endif

@endsection
