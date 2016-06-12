@extends('layouts.admin',
    ['title'=> 'Dashboard Panel', 'subTitle'=>'Dashboard',
     'activeOpen'=> 'DashboardPanel', 'activeOpenSub'=> 'Dashboard',
     'website'=>\App\Option::findOrFail(1)->value])

@section('content')

    Works!

@endsection