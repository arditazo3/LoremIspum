@extends('layouts.admin',
    ['title'=> 'Account Panel', 'subTitle'=>'Contacts',
     'activeOpen'=> 'MyAccountPanel', 'activeOpenSub'=> 'Mailbox',
     'website'=>\App\Option::findOrFail(1)->value])


@section('content')



@endsection

@section('myScript')

    <script>

    </script>

@endsection