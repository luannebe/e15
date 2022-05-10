@extends('layouts/main',['body_class' => 'delete_report'
])

@section('title')
    RMA Observer Reports Tracker - Confirm Report Deletion
@endsection

@section('header')
     @include('includes/private-header')
@endsection

@section('content')
    <div class="container text-center">
        <h1 class="mt-5 mb-3">Confirm Deletion</h1>
        <p>Are you sure you want to delete Report id  <strong>{{ $report->id }}</strong>?</p>

        <form method='POST' action='/tracker/{{ $report->id }}'>
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="text-center m-5"><button type='submit' class='btn btn-danger btn-small ' >Yes, delete it!</button></div>
        </form>

        <p class='cancel'>
            <a href='/tracker'>No, I changed my mind.</a>
        </p>
    </div>


@endsection