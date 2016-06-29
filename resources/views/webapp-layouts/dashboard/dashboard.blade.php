@extends('layouts.admin',
    ['title'=> 'Dashboard Panel', 'subTitle'=>'Dashboard',
     'activeOpen'=> 'DashboardPanel', 'activeOpenSub'=> 'Dashboard',
     'website'=>\App\Option::findOrFail(1)->value])

@section('content')

    @if(\Illuminate\Support\Facades\Session::has('deleted_patient'))
        @include('includes.notification-alert', ['alert_type'=> 'danger', 'msg'=> session('deleted_patient')])
    @elseif(\Illuminate\Support\Facades\Session::has('updated_patient'))
        @include('includes.notification-alert', ['alert_type'=> 'warning', 'msg'=> session('updated_patient')])
    @elseif(\Illuminate\Support\Facades\Session::has('created_patient'))
        @include('includes.notification-alert', ['alert_type'=> 'success', 'msg'=> session('created_patient')])
    @endif

    @if(\Illuminate\Support\Facades\Session::has('deleted_user'))
        @include('includes.notification-alert', ['alert_type'=> 'danger', 'msg'=> session('deleted_user')])
    @elseif(\Illuminate\Support\Facades\Session::has('updated_user'))
        @include('includes.notification-alert', ['alert_type'=> 'warning', 'msg'=> session('updated_user')])
    @elseif(\Illuminate\Support\Facades\Session::has('created_user'))
        @include('includes.notification-alert', ['alert_type'=> 'success', 'msg'=> session('created_user')])
    @endif

@endsection

@section('myScript')

    @include('includes.myScript.skin_configJS')

@endsection