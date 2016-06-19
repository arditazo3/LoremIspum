@extends('layouts.admin',
    ['title'=> 'Account Panel', 'subTitle'=>'My Profile',
     'activeOpen'=> 'MyAccountPanel', 'activeOpenSub'=> 'MyProfile',
     'website'=>$website])

@section('myCSS')
    @include('includes.myCSS.toastr')
@endsection

@section('content')

    <!--PUT THE NICE FORM HERE-->
    @include('webapp-layouts.my_account.form_user')

@endsection

@section('myScript')

    @include('includes.myScript.toastr')
    @include('includes.myScript.jquery_validate')

    @include('includes.myScript.my_profileJS')

@endsection