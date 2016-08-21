@extends('layouts.admin-sign')

@section('content')

    <div>
        <div>
            <h1 class="logo-name">WA</h1>
        </div>
        <h3>Welcome to WebApp.al</h3>

        <p>Login in. To see it in action.</p>
        {!! Form::open(['method'=>'POST', 'action'=>'Auth\AuthController@login', 'class'=>'m-t', 'role'=>'form']) !!}
        <div class="form-group">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-user"></i></span>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-lock"></i></span>
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
            </div>
        </div>

        {{--Notifications login--}}
        @include('includes.form-error-specify', ['field'=>'username', 'typeAlert'=>'danger'])
        @include('includes.form-error-specify', ['field'=>'password', 'typeAlert'=>'danger'])

        {!! Form::submit('Login', ['class'=>'btn btn-primary block full-width m-b']) !!}

        <a href="{{ url('/password/reset') }}" id="forget-password" class="forget-password">Forgot Password?</a>
        <p class="text-muted text-center">
            Do not have an account?
        </p>
        <a href="{{ url('/register') }}" id="register-btn" class="uppercase">Create an account</a>
        {!! Form::close() !!}
        <p class="m-t">{{ \Carbon\Carbon::now()->year }} © WebApp.al</p>
    </div>

@endsection