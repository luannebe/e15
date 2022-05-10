@extends('layouts/main')

@section('head')
<style>
table {
    margin-top:50px;
    font-size:10px;
}
</style>
@endsection

@section('content')

    <h1>Practice</h1>

    {{-- Avaiable practice methods --}}
    @foreach($methods as $method)
        <a href='{{ str_replace('practice', '/practice/', $method) }}'>{{ $method }}</a><br>
    @endforeach

   

@endsection