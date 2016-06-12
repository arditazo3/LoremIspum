@extends('layouts.admin-sign')

@section('content')

    <div>
        <div>

            <h1 class="logo-name">WA</h1>

        </div>
        <h3>Register to WebApp.al</h3>
        <p>Create account to see it in action.</p>
        {!! Form::open(['method'=>'POST', 'action'=>'Auth\AuthController@register', 'class'=>'m-t', 'role'=>'form']) !!}


        <div class="form-group">
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Full Name']) !!}
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            {!! Form::password('password', ['class'=>'form-control placeholder-no-fix', 'placeholder'=>'Password']) !!}
        </div>
        <div class="form-group">
            <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label>
            </div>
        </div>

        @include('includes.form-error-specify', ['field'=>'name'])
        @include('includes.form-error-specify', ['field'=>'email'])
        @include('includes.form-error-specify', ['field'=>'password'])

        {!! Form::submit('Register', ['class'=>'btn btn-primary block full-width m-b']) !!}

        <p class="text-muted text-center">
            Already have an account?
        </p>
        <a class="btn btn-primary btn-sm btn-block" href="{{ url('login') }}">Login</a>
        {!! Form::close() !!}
        <p class="m-t">{{ \Carbon\Carbon::now()->year }} © WebApp.al</p>
    </div>

@endsection
