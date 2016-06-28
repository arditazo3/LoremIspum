<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="WebApp.al" name="description"/>
    <meta content="WebApp.al" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ URL::asset('img/logo.ico') }}"/>

    <title>WebApp.al</title>

    <link href="{{ URL::asset('css/libs.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css"/>

    {{--PUT SOME CSS WITH LOVE, BELLOW--}}
    @yield('myCSS')

</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <span>
                                <img alt="image" class="img-circle" src="{{ Auth::user()->image ? ($website . Auth::user()->image->path) : ($website . 'img/user-no_photo.png')}}" width="70"/>
                            </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs">
                                        <strong class="font-bold">
                                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                        </strong>
                                    </span> <span class="text-muted text-xs block">
                                        {{ Auth::user()->role ? Auth::user()->role->status : 'Guess' }}
                                        <b class="caret"></b></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        WA
                    </div>
                </li>

                <li class="{{ isset($activeOpen) && $activeOpen == 'DashboardPanel' ? 'active' : '' }}">

                    <a href="{{ url('/admin') }}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span> <span></span></a>
                </li>

                {{--PATIENT ITEM--}}
                {{--- NEW PATIENT--}}
                <li class="{{ isset($activeOpen) && $activeOpen == 'PatientPanel' ? 'active' : '' }}">
                    <a href="index.html"><i class="fa fa-users"></i> <span class="nav-label">Patients</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li class="{{ isset($activeOpenSub) && $activeOpenSub == 'NewPatient' ? 'active' : '' }}">
                            <a href="{{ route('admin.patient.create') }}"><i class="fa fa-user"></i>New Patient</a></li>

                    </ul>
                </li>

                {{--CALENDAR ITEM--}}
                {{--- APPOINTMENTS--}}
                {{--- NEW EVENT--}}
                <li class="{{ isset($activeOpen) && $activeOpen == 'CalendarPanel' ? 'active' : '' }}">
                    <a href="index.html"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li class="{{ isset($activeOpenSub) && $activeOpenSub == 'Calendar' ? 'active' : '' }}">
                            <a href="{{ route('admin.calendar.index') }}"><i class="fa fa-calendar"></i>Appointments</a></li>

                    </ul>
                </li>


                <li class="{{ isset($activeOpen) && $activeOpen == 'MyAccountPanel' ? 'active' : '' }}">
                    <a href="index.html"><i class="fa fa-user-md"></i> <span class="nav-label">My Account</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li class="{{ isset($activeOpenSub) && $activeOpenSub == 'MyProfile' ? 'active' : '' }}">
                            <a href="{{ route('admin.user.profile') }}"><i class="fa fa-meh-o"></i>My Profile</a></li>

                        <li class="{{ isset($activeOpenSub) && $activeOpenSub == 'Contacts' ? 'active' : '' }}">
                            <a href="{{ route('admin.user.contacts') }}"><i class="fa fa-phone"></i>Contacts</a></li>

                        <li class="{{ isset($activeOpenSub) && $activeOpenSub == 'Mailbox' ? 'active' : '' }}">
                            <a href="{{ route('admin.user.mailbox') }}"><i class="fa fa-envelope"></i>Mailbox</a></li>

                    </ul>
                </li>



            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">

        {{--NAVIGATION TOP--}}
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome WebApp.al</span>
                    </li>

                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        {{--END NAVIGATION TOP--}}


        {{--BODY HEADER--}}
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>{{ (isset($subTitle)== true) ? $subTitle : 'Dashboard' }}</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ url('/admin') }}">{{ (isset($title)== true) ? $title : 'Dashboard' }}</a>
                    </li>
                    <li class="active">
                        <strong>{{ (isset($subTitle)== true) ? $subTitle : 'Dashboard' }}</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        {{--BODY HEADER END--}}



        <div class="wrapper wrapper-content animated fadeInRight">

            {{--THE CONTENT OF BODY--}}
            @yield('content')

        </div>

        {{--FOOTER--}}
        <div class="footer">
            <div class="pull-right">
                Copyright <strong>WebApp.al</strong>
            </div>
            <div>

            </div>
        </div>
        {{--FOOTER END--}}

    </div>
</div>


<!-- BEGIN CORE PLUGINS -->
<script src="{{ URL::asset('js/libs.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

{{--PUT SOME NICE SCRIPT HERE--}}
@yield('myScript')

</body>

</html>
