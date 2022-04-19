@extends('layouts/main')

@section('title')
    Update author {{ $author->first_name}} {{ $author->last_name}}
@endsection

@section('content')


<h1>Update author</h1>
<h2>{{ $author->first_name}} {{ $author->last_name}}</h2>


    <form method='POST' action='/authors/{{$author->id}}'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}
        {{ method_field('put')}}

        <label for='first_name'>* First Name</label>
        <input type='text' name='first_name' id='first_name' value='{{ old("first_name", $author->first_name) }}'>
        @include('includes/error-field', ['fieldName' => 'first_name'])

        <label for='last_name'>* Last Name</label>
        <input type='text' name='last_name' id='last_name' value='{{ old("last_name", $author->last_name) }}'>
        @include('includes/error-field', ['fieldName' => 'last_name'])

        <label for='birth_year'>* Birth Year (YYYY)</label>
        <input type='text' name='birth_year' id='birth_year' value='{{ old("birth_year"), $author->birth_year }}'>
        @include('includes/error-field', ['fieldName' => 'birth_year'])

        <label for='bio_url'>Bio URL</label>
        <input type='text' name='bio_url' id='bio_url' value='{{ old("bio_url", $author->bio_url) }}'>
        @include('includes/error-field', ['fieldName' => 'bio_url'])

        <button type='submit' class='btn btn-primary'>Add Author</button>

        @if(count($errors) > 0)
        <div class='alert alert-danger'>
            Please correct the above errors.
        </div>
        @endif

    </form>
@endsection