@extends('layouts/main')

@section('title')
    Add an author
@endsection

@section('content')


<h1>Add an author</h1>

    <p>Want to add an author to your list that isn’t in our library? Not a problem- you can add it here!</p>

    <form method='POST' action='/authors'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='first_name'>* First Name</label>
        <input type='text' name='first_name' id='first_name' value='{{ old("first_name") }}'>
        @include('includes/error-field', ['fieldName' => 'first_name'])

        <label for='last_name'>* Last Name</label>
        <input type='text' name='last_name' id='last_name' value='{{ old("last_name") }}'>
        @include('includes/error-field', ['fieldName' => 'last_name'])

        <label for='birth_year'>* Birth Year (YYYY)</label>
        <input type='text' name='birth_year' id='birth_year' value='{{ old("birth_year") }}'>
        @include('includes/error-field', ['fieldName' => 'birth_year'])

        <label for='bio_url'>Bio URL</label>
        <input type='text' name='bio_url' id='bio_url' value='{{ old("bio_url", "http://") }}'>
        @include('includes/error-field', ['fieldName' => 'bio_url'])

        <button type='submit' class='btn btn-primary'>Add Author</button>

        @if(count($errors) > 0)
        <div class='alert alert-danger'>
            Please correct the above errors.
        </div>
        @endif

    </form>
@endsection