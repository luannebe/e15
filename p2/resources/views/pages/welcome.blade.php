@extends('layouts/main')

@section('header')
    <header class="flex flex-row items-center">
        <img class="block w-24 mr-4 mt-0 mb-0 flex-none " src='/images/heads.png' id="logo" />
        <h1 class="flex-grow mb-0">Flip-A-Coin Decision&nbsp;Maker</h1>
    </header> 
@endsection

@section('form')
    <p class="prose prose-lg lg:prose-xl font-bold mt-4 xl:ml-32 mb-8">Too many decisions sapping your energy?<br>Give yourself a break and <em>let the coin decide!</em><p>

    <form method='GET' action='/process' novalidate >
        <div class="grid grid-cols-1 gap-6 prose max-w-none md:prose-lg lg:prose-xl">

            <label class="flex flex-row items-center">
                <span class="block w-28 mr-4 flex-none text-right">Should I</span>
                <input type='text' name='question' id='question' value='{{old('question', $question)}}' placeholder="have an ice cream sundae now" class="mt-1 block rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 flex-grow mr-2">
                <span class="block grow-0 d" > ?</span>
            </label>

            <label class="flex flex-row items-center">
                <span class="block w-28 mr-4 flex-none leading-none text-right">Heads means</span>
                
                <input type="radio" id="Yes" name="headsMeans" value="Yes"
                {{(old('headsMeans', $headsMeans) == 'Yes' || is_null($headsMeans)) ? 'checked' : ''}}
                class="mr-1 inline-block">
                <label for="Yes" class="mr-6">Yes, do it!</label><br>
                
                <input type="radio" id="No" name="headsMeans" value="No"
                {{(old('headsMeans', $headsMeans) == 'No') ? 'checked' : ''}}
                class="mr-1 inline-block">
                <label for="No">No, don't do it.</label>
            </label>

            <label class="flex flex-row items-center">
                <span class="block w-28 mr-4 flex-none leading-none text-right">Number tosses</span>
                <input type='number' id='numTosses' name='numTosses'  min="1" max="5" step="2" value='{{old('numTosses', $numTosses)}}'
                class='mt-1 block rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0'> 
            </label>

            <button type='submit' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-32" >Tell me what to do!</button>
        </div>
    </form>
@endsection
@section('results')
    @if(count($errors) > 0)
        <ul class="list-disc text-red-600 font-bold">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    @if(!is_null($decision))
        <ul class='flex flex-row mt-8 list-none space-x-1.5 justify-center'>
            @foreach($tossResults as $numFlips)
                <li class="w-28 h-28 relative m-0 p-0 [perspective: 40rem]">
                    <!-- coin's parent container -->
                    <!-- tried multiple ways of getting variable into class e.g. animate-flip<variable>, but apparently tailwind purged it.
                    see https://stackoverflow.com/questions/68909968/laravel-conditional-tailwind-class-with-default-value -->

                    @switch($numFlips)
                        @case('3')
                            <div class="relative [transform-style:preserve-3d] animate-flip3">
                            @break
                        @case('4')
                            <div class="relative [transform-style:preserve-3d] animate-flip4">
                            @break
                        @case('5')
                            <div class="relative [transform-style:preserve-3d] animate-flip5">
                            @break
                        @case('6')
                            <div class="relative [transform-style:preserve-3d] animate-flip6">
                            @break
                        @case('7')
                            <div class="relative [transform-style:preserve-3d] animate-flip7">
                            @break
                        @case('8')
                            <div class="relative [transform-style:preserve-3d] animate-flip8">
                            @break
                        @case('9')
                            <div class="relative [transform-style:preserve-3d] animate-flip9">
                            @break
                        @case('10')
                            <div class="relative [transform-style:preserve-3d] animate-flip10">
                            @break
                        @default
                             <div class="relative [transform-style:preserve-3d] ">
                    @endswitch
                        <img class="w-full m-0 [mix-blend-mode:multiply]  [backface-visibility:hidden]" src='/images/heads.png' id="logo" />
                        <img class="w-full absolute inset-0 m-0  [mix-blend-mode:multiply] [backface-visibility:hidden] [transform:rotateY(-180deg)]" src='/images/tails.png' id="logo" />
                    </div>
                </li>            

            @endforeach
        </ul>
        @php
        // change "voice" of question to make it sound like a response
        $response = str_replace('my', 'your', $question);
        @endphp
        @if($decision == 'Yes')
            <p class='prose prose-lg lg:prose-xl  mt-0 lg:ml-0 max-w-none font-bold text-center  opacity-0 animate-fadein underline decoration-green-500 decoration-wavy decoration-2 underline-offset-8'>
            Yes, go ahead ... {{$response}}.
        @else
            <p class='prose prose-lg lg:prose-xl  mt-0 lg:ml-0 max-w-none font-bold text-center   opacity-0 animate-fadein underline decoration-red-500 decoration-wavy decoration-2  underline-offset-8'>
            No, don&rsquo;t {{$response}}.
        @endif
            </p>
    @endif 
@endsection