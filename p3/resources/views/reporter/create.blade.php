@extends('layouts/main', ['body_class' => 'make_report'])

@section('title')
    Make an Observer Report
@endsection

@section('header')
     @include('includes/public-header')
@endsection

@section('content')
<section  id='main' class="container d-flex flex-column justify-content-evenly align-items-center h-100">
    <h1 class="m-5">Make an Observer Report</h1>

     <form class="row g-3"  method='POST' action='/make-a-report' enctype="multipart/form-data">
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}
        {{-- Date --}}
        <div class="col-12">
            <label for="date_observed" class="form-label">*Date Observed</label>
            <input type="date" class="form-control" id="date_observed" name="date_observed" value='{{ old("date_observed", $date_observed ) }}'>
            @include('includes/error-field', ['fieldName' => 'date_observed'])
        </div>
        {{-- Location --}}
        <div class="col-6">
            <label for="street_number" class="form-label">*Street Number</label>
            <input type="text" class="form-control" id="street_number" name="street_number" 
            value={{ old("street_number", $street_number) }}>
            @include('includes/error-field', ['fieldName' => 'street_number'])         
        </div>
        <div class="col-6">
            <label for="street_name" class="form-label">*Street Name</label>
            <input type="text" class="form-control" id="street_name" name="street_name" value='{{ old("street_name",  "Massachusetts Ave NW") }}'>   
            @include('includes/error-field', ['fieldName' => 'street_name'])      
        </div>
        {{-- Category --}}
        <div class="col-12">
            <label for="categories" class="form-label">*Categories</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="1" id="fence" 
                {{ ( is_array( old('categories') ) && in_array('1', old('categories')) ) ? 'checked' : '' }} 
                >
                <label class="form-check-label text-capitalize" for="fence">
                    Fence around tree wrong size, absent or damaged
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="2" id="excavating" 
                {{ ( is_array( old('categories') ) && in_array('2', old('categories')) ) ? 'checked' : '' }}
                >
                <label class="form-check-label text-capitalize " for="excavating">
                    Crew is excavating under/near trees
                </label>
            </div>
           <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="3" id="roots" 
                {{ ( is_array( old('categories') ) && in_array('3', old('categories')) ) ? 'checked' : '' }}
                >
                <label class="form-check-label text-capitalize" for="roots">
                    Danger to roots larger than 2 inches in diameter
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="4" id="branches" 
                {{ ( is_array( old('categories') ) && in_array('4', old('categories')) ) ? 'checked' : '' }} 
                >
                <label class="form-check-label text-capitalize" for="branches">
                    Branches cut or broken
                </label>
            </div>
           <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="5" id="other"
                {{ ( is_array( old('categories') ) && in_array('5', old('categories')) ) ? 'checked' : '' }}
                >
                <label class="form-check-label text-capitalize" for="other">
                    Other
                </label>
            </div>
             @include('includes/error-field', ['fieldName' => 'categories'])
        </div>
        {{-- Photo --}}
        <div class="col-12">
            <label for="filename" class="form-label">Upload a photo</label>
            <input class="form-control" type="file" id="filename" name="filename" value='{{ old("filename", $filename) }}'
            >
        </div>
        {{-- Photo caption --}}
        <div class="col-12">
            <label for="caption" class="form-label">Brief photo caption</label>
            <input type="text" class="form-control" id="caption" name="caption" value='{{ old("caption", $caption) }}'>         
        </div>
        {{-- Heritage tree --}}
        <div class="col-12">
            <label for="heritage_tree" class="form-label">Heritage Tree?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="heritage_tree" id="Yes" value="1" {{(old('heritage_tree', $heritage_tree) == '1') ? 'checked' : ''}}>
                <label class="form-check-label" for="Yes">
                    Yes
                </label>
                </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="heritage_tree" id="No" value="0" {{(old('heritage_tree', $heritage_tree) == '0') ? 'checked' : ''}}>
                <label class="form-check-label" for="No">
                    No
                </label>
            </div>
        </div>
        {{-- Comments --}}
        <div class="col-12">
            <label for="comments" class="form-label">Comments/Details</label>
            <textarea class="form-control" id="comments" name="comments" rows="6">{{ old("comments", $comments) }}</textarea>
        </div>
        {{-- Observer name --}}
        <div class="col-6">
            <label for="observer_first_name" class="form-label">*My First Name</label>
            <input type="text" class="form-control" id="observer_first_name" name="observer_first_name" value='{{ old("observer_first_name", $observer_first_name) }}'>  
            @include('includes/error-field', ['fieldName' => 'observer_first_name'])       
        </div>
        <div class="col-6">
            <label for="observer_last_name" class="form-label">*My Last Name</label>
            <input type="text" class="form-control" id="observer_last_name" name="observer_last_name" value='{{ old("observer_last_name", $observer_last_name) }}'> 
            @include('includes/error-field', ['fieldName' => 'observer_last_name'])        
        </div>
        <div class="col-12">
            <label for="observer_email" class="form-label">*My Email</label>
            <input type="email" class="form-control" id="observer_email" name="observer_email" value='{{ old("observer_email", $observer_email) }}'>
            @include('includes/error-field', ['fieldName' => 'observer_email'])
        </div>

        <button type='submit' class='mt-5 btn btn-primary'>Submit Report</button>

        @if(count($errors) > 0)
        <div class='alert alert-danger'>
            Please correct the above errors.
        </div>
        @endif

    </form>
 </section>       


@endsection