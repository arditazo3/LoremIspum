<h1>List of Patients</h1>

@foreach($patients as $patient)

    <p>{{ $patient->first_name  }} - {{ $patient->last_name }}</p>

@endforeach