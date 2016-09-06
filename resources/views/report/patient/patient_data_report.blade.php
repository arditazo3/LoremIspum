<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="{{ URL::asset('css/libs.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>

<h1>List of Patients</h1>

<div class="ibox-content">
    <div class="table-responsive">
        <table class="table header-fixed" style="font-weight: bold">
            <thead>
            <tr style="font-weight: bold">
                <th>First name</th>
                <th>Last name</th>
            </tr>
            </thead>
            <tbody>

            @foreach($patients as $patient)
                <tr style="font-weight: bold">
                    <th>{{ $patient->first_name  }}</th>
                    <th>{{ $patient->last_name }}</th>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

</body>
</html>

