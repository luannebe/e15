@extends('layouts/main', ['body_class' => 'welcome'])

@section('title')
    Save Trees - Make an Observer Report
@endsection

@section('header')
     @include('includes/public-header')
@endsection

@section('content')

<section  id='main' class="container d-flex flex-column justify-content-evenly align-items-center h-100">
        <p class="fs-3">In future iterations of the app, this public page will provide background on why, how, and when to submit an Observer&nbsp;Report to Restore Mass Ave.</p>

        <a href="/make-a-report" class="btn btn-lg btn-success fs-2 p-4">Make an Observer Report</a>

        <p class>Authorized managers <a href="/tracker">view reports</small></a>.
</section>

@endsection