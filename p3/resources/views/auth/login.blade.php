@extends('layouts/main',['body_class' => 'login'
])

@section('header')
     @include('includes/private-header')
@endsection

@section('content')
<section  id='main' class="container">   

    <h1 class="m-5">Login - RMA Observer Reports Tracker</h1>

    <p>This area is for authorized users. Want to help save trees? Contact <a href='https://restoremassave.org/donate-contact'>Restore Mass Ave</a></p>

        <form method='POST' action='/login'>

            {{ csrf_field() }}

            <label for='email'>E-Mail Address</label>
            <input id='email' type='email' name='email' value='{{ old('email') }}' autofocus>
            @include('includes.error-field', ['fieldName' => 'email'])

            <label for='password'>Password</label>
            <input id='password' type='password' name='password'>
            @include('includes.error-field', ['fieldName' => 'password'])

            <label>
                <input type='checkbox' name='remember' {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>

            <button type='submit' class='btn btn-success'>Login</button>

        </form>
    </section>

@endsection