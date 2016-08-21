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
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-user"></i></span>
                {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Username']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-github-alt"></i></span>
                {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'First Name']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-github-alt"></i></span>
                {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Last Name']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-lock"></i></span>
                {!! Form::password('password', ['class'=>'form-control placeholder-no-fix', 'placeholder'=>'Password']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-lock"></i></span>
                {!! Form::password('password_confirmation', ['class'=>'form-control placeholder-no-fix', 'placeholder'=>'Confirm Password']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label>
            </div>
        </div>

        @include('includes.form-error-specify', ['field'=>'username', 'typeAlert'=>'danger'])
        @include('includes.form-error-specify', ['field'=>'name', 'typeAlert'=>'danger'])
        @include('includes.form-error-specify', ['field'=>'email', 'typeAlert'=>'danger'])
        @include('includes.form-error-specify', ['field'=>'password', 'typeAlert'=>'danger'])

        {!! Form::submit('Register', ['class'=>'btn btn-primary block full-width m-b']) !!}

        <p class="text-muted text-center">
            Already have an account?
        </p>
        <a class="btn btn-primary btn-sm btn-block" href="{{ url('login') }}">Login</a>
        {!! Form::close() !!}
        <p class="m-t">{{ \Carbon\Carbon::now()->year }} © WebApp.al</p>
    </div>

@endsection
