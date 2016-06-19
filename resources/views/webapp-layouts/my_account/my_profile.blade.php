@extends('layouts.admin',
    ['title'=> 'Account Panel', 'subTitle'=>'My Profile',
     'activeOpen'=> 'MyAccountPanel', 'activeOpenSub'=> 'MyProfile',
     'website'=>$rootUrl])

@section('myCSS')
    @include('includes.myCSS.toastr')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{--START FORM--}}
            {!! Form::open(['method'=>'POST', 'action'=>'UserController@updateProfile',
                    'files'=>true, 'id'=>'formUpdateProfile']) !!}

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>My profile information</h5>
                    <div class="ibox-tools">

                        <button type="button" class="btn btn-info btn-sm" id="btnEditUserProfileData"><i class="fa fa-edit"></i> Edit</button>

                        {!! Form::submit('Save edit', ['class'=>'btn btn-primary btn-sm', 'id'=>'btnSaveEditUser']) !!}

                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">

                    {{--GENERAL TOP INFORMAIIONS--}}
                    <div class="row">

                        <div class="col-sm-4 b-r">

                            <div id="defaultProfilePicture">
                                <img src="{{ $user->image ? ($rootUrl . $user->image->path) : ($rootUrl . 'img/user-no_photo.png')}}"
                                     class="img-responsive" alt=""
                                     style="max-width: 200px; max-height: 150px;">

                                <br>
                                    <button type="button" class="btn btn-info btn-sm" id="btnChangeProfilePicture">
                                        <i class="fa fa-picture-o"></i> Edit Picture
                                    </button>
                            </div>

                            {{--CHANGE IMAGE AND UPLOAD NEW PICTURE--}}
                            <div class="fileinput fileinput-new pull-left" data-provides="fileinput"
                                 id="changeProfilePicture" style="display: none">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img data-src="holder.js/100%x100%"
                                         src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+"
                                         alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"
                                     style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-w-m btn-info btn-sm btn-file"><span
                                                class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input
                                                type="file" name="file"></span>
                                    <a href="#" class="btn btn-w-m btn-danger btn-sm fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>

                                        <button type="button" class="btn btn-w-m btn-white btn-sm" id="btnBackProfilePicture">Don't change</button>
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-8 b-r">
                            <div class="form-group ">
                                {!! Form::label('first_name', 'First name', ['class'=>'control-label']) !!}
                                {!! Form::text('first_name', $user->first_name, ['class'=>'form-control', 'placeholder'=>'First name']) !!}
                                @include('includes.form-error-specify', ['field'=>'first_name', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('last_name', 'Last name', ['class'=>'control-label']) !!}
                                {!! Form::text('last_name', $user->last_name, ['class'=>'form-control', 'placeholder'=>'Last name']) !!}
                                @include('includes.form-error-specify', ['field'=>'last_name', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
                                {!! Form::text('email', $user->email, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                                @include('includes.form-error-specify', ['field'=>'email', 'typeAlert'=>'danger'])
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 b-r">

                            <div class="form-group ">
                                {!! Form::label('phone', 'Phone', ['class'=>'control-label']) !!}
                                {!! Form::text('phone', $user->phone, ['class'=>'form-control', 'placeholder'=>'Phone']) !!}
                                @include('includes.form-error-specify', ['field'=>'phone', 'typeAlert'=>'danger'])
                            </div>

                        </div>

                        <div class="col-sm-6 b-r">

                            <div class="form-group ">
                                {!! Form::label('password', 'Password', ['class'=>'control-label']) !!}
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Change the password']) !!}
                                @include('includes.form-error-specify', ['field'=>'password', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group " id="divComfirmPassword">
                                {!! Form::label('confirm_password', 'Confirm Password', ['class'=>'control-label']) !!}
                                {!! Form::password('confirm_password', ['class'=>'form-control', 'placeholder'=>'Confirm Password']) !!}
                                @include('includes.form-error-specify', ['field'=>'confirm_password', 'typeAlert'=>'danger'])
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            {!! Form::close() !!}
            {{--END FORM--}}
        </div>
    </div>

@endsection

@section('myScript')

    @include('includes.myScript.toastr')
    @include('includes.myScript.jquery_validate')

    @include('includes.myScript.my_profileJS')

@endsection