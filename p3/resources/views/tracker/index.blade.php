@extends('layouts/main',['body_class' => 'reports_list'
])

@section('title')
    RMA Observer Reports Tracker - View All Reports
@endsection

@section('header')
     @include('includes/private-header')
@endsection

@section('content')

    <h1 class="mt-5 mb-3">RMA Observer Reports Tracker</h1>
    <p class="text-center">
        Hello {{ Auth::user()->name }}!
    <br>
        There are currently {{$count}} reports in the database.<p>

    {{-- Reports table output --}}
    @if($rows)
    <div class="container">
        <table class='table table-bordered table-striped'>
            <thead>
                <tr>
                    @foreach($titles as $title)
                        <th>{{$title}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($rows as $fields)
            <tr>
                @foreach($fields as $field)
                    <td>{!! html_entity_decode($field) !!}</td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif


@endsection