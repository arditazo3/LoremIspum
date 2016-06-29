@extends('layouts.admin',
    ['title'=> 'Patient Panel', 'subTitle'=>'New Patient',
     'activeOpen'=> 'PatientPanel', 'activeOpenSub'=> 'NewPatient',
     'website'=>\App\Option::findOrFail(1)->value])

@section('myCSS')
    @include('includes.myCSS.toastr')
    @include('includes.myCSS.datatablesCSS')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{--START FORM--}}
            {!! Form::open(['method'=>'POST', 'action'=>'PatientController@store', 'role'=>'form',
                'id'=>'formSaveNewPatient', 'files'=>true]) !!}

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Fill the form to create a new patient</h5>
                    <div class="ibox-tools">

                        <button type="button" class="btn btn-danger btn-sm" id="btnDeletePatient">
                            <i class="fa fa-remove"></i> Delete patient
                        </button>

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#searchModal"
                                data-backdrop="static" data-keyboard="false" id="searchPatientsModal">
                            <i class="fa fa-search"></i> Search
                        </button>

                        {!! Form::submit('Save patient', ['class'=>'btn btn-primary btn-sm', 'id'=>'btnSavePatientForm']) !!}

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
                            <div class="fileinput fileinput-new pull-left" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img data-src="holder.js/100%x100%"
                                         src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+"
                                         alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"
                                     style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-w-m btn-info btn-file"><span
                                                class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input
                                                type="file" name="..."></span>
                                    <a href="#" class="btn btn-w-m btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5 b-r">
                            <input type="hidden" id="id_patient_hidden" />

                            <div class="form-group ">
                                {!! Form::label('first_name', 'First name', ['class'=>'control-label']) !!}
                                {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'First name']) !!}
                                @include('includes.form-error-specify', ['field'=>'first_name', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('last_name', 'Last name', ['class'=>'control-label']) !!}
                                {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Last name']) !!}
                                @include('includes.form-error-specify', ['field'=>'last_name', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('address', 'Address', ['class'=>'control-label']) !!}
                                {!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Address']) !!}
                                @include('includes.form-error-specify', ['field'=>'address', 'typeAlert'=>'danger'])
                            </div>

                        </div>

                        <div class="col-sm-3 b-r">
                            <div class="form-group ">
                                {!! Form::label('nation', 'Country', ['class'=>'control-label']) !!}
                                <div class="divNation">
                                    {!! Form::select('nation', [''=>'Select a nation...'] + $countries, null, ['class'=>'form-control']) !!}
                                </div>
                                @include('includes.form-error-specify', ['field'=>'nation', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('city', 'City', ['class'=>'control-label']) !!}
                                <div class="divCity">
                                    {!! Form::select('city', [''=>'Select a city...'] + $cities, null, ['class'=>'form-control']) !!}
                                </div>
                                @include('includes.form-error-specify', ['field'=>'city', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('zip_code', 'Zip code', ['class'=>'control-label']) !!}
                                {!! Form::text('zip_code', null, ['class'=>'form-control', 'placeholder'=>'Zip code']) !!}
                            </div>

                        </div>

                    </div>
                    {{--END GENERAL TOP INFORMATIONS--}}

                    <div class="row">

                        <div class="panel-group" id="accordion">
                            <div class="panel panel-info" id="panel1">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-target="#personalData"
                                           href="#collapseOne">
                                            Personal data
                                        </a>
                                    </h4>
                                </div>
                                <div id="personalData" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        {{--PERSONAL DATA--}}
                                        <div class="col-sm-6 b-r">

                                            <div class="form-group ">
                                                {!! Form::label('adult_child', 'Adult / Child', ['class'=>'control-label']) !!}
                                                <div class="divAdult">
                                                    {!! Form::select('adult_child', ['0'=>'Select...'] + $adults, null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('sex', 'Sex', ['class'=>'control-label']) !!}
                                                <div class="divSex">
                                                    {!! Form::select('sex', ['0'=>'Select a gender...'] + $genders, null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('date_birth', 'Birth date', ['class'=>'control-label']) !!}

                                                <div class="form-group" id="data_1">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-calendar"></i></span>
                                                        {!! Form::text('date_birth', \Carbon\Carbon::now()->format('d/m/Y'), ['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('birth_place', 'Birth place', ['class'=>'control-label']) !!}
                                                {!! Form::select('birth_place', ['0'=>'Select...'] + $cities, null, ['class'=>'form-control']) !!}
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('marital_status', 'Marital status', ['class'=>'control-label']) !!}
                                                {!! Form::select('marital_status', ['0'=>'Select...'] + $marital_status, null, ['class'=>'form-control']) !!}
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('language', 'Language', ['class'=>'control-label']) !!}
                                                {!! Form::select('language', ['0'=>'Select...'] + $languages, null, ['class'=>'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-6 b-r">

                                            <div class="form-group ">
                                                {!! Form::label('id_dentist', 'Dentist', ['class'=>'control-label']) !!}
                                                {!! Form::text('id_dentist', null, ['class'=>'form-control', 'placeholder'=>'Dentist']) !!}
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('tax_code', 'Fiscal code', ['class'=>'control-label']) !!}
                                                {!! Form::text('tax_code', null, ['class'=>'form-control', 'placeholder'=>'Fiscal code']) !!}
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('proffession', 'Proffession', ['class'=>'control-label']) !!}
                                                {!! Form::select('proffession', ['0'=>'Select...'] + $proffessions, null, ['class'=>'form-control']) !!}
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('personal_phone', 'Personal phone', ['class'=>'control-label']) !!}

                                                <div class="input-group m-b"><span class="input-group-addon"><i
                                                                class="fa fa-mobile-phone"></i></span>
                                                    {!! Form::text('personal_phone', null, ['class'=>'form-control', 'placeholder'=>'Personal phone']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('office_phone', 'Office phone', ['class'=>'control-label']) !!}

                                                <div class="input-group m-b"><span class="input-group-addon"><i
                                                                class="fa fa-phone"></i></span>
                                                    {!! Form::text('office_phone', null, ['class'=>'form-control', 'placeholder'=>'Office phone']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}

                                                <div class="input-group m-b"><span class="input-group-addon"><i
                                                                class="fa fa-envelope"></i></span>
                                                    {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                                                </div>
                                                @include('includes.form-error-specify', ['field'=>'email', 'typeAlert'=>'danger'])
                                            </div>
                                        </div>
                                        {{--END PERSONAL DATA--}}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" id="panel2">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-target="#collapseTwo"
                                           href="#collapseTwo" class="collapsed">
                                            Collapsible Group Item #2
                                        </a>
                                    </h4>

                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">Anim pariatur
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" id="panel3">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-target="#collapseThree"
                                           href="#collapseThree" class="collapsed">
                                            Collapsible Group Item #3
                                        </a>
                                    </h4>

                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">Anim pariatur
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            {{--END FORM--}}

        </div>
    </div>

    {{--SEARCH MODAL--}}
    <div class="modal inmodal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title pull-left">Search patient</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-striped table-bordered table-hover dataTables-example"
                           id="tableAllPatients">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Company name</th>
                            <th>Address</th>
                            <th>City</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--END SEARCH MODAL--}}

@endsection

@section('myScript')

    @include('includes.myScript.toastr')
    @include('includes.myScript.jquery_validate')
    @include('includes.myScript.datatablesJS')

<script>

    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var allPatientsDataGlob = '';
        var urlAllPatients = '{{ route('api/allPatientsAjax') }}';

        var $btnDeleteGlob = $('#btnDeletePatient').hide();

        // Create Patient open list of patient when button is clicked
        $('#searchPatientsModal').click(function () {

            // retrive all patients whith AJAX
            if (allPatientsDataGlob == '') {
                $.ajax({
                    url: urlAllPatients,
                    type: 'GET',
                    paging: false,
                    searching: false,
                    data: {
                        _token: CSRF_TOKEN
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data);
                        allPatientsDataGlob = data;
                        cicleDataPatientsAjax(data);
                    },
                    error: function () {
                        console.log('Error' + url);
                        console.log('CSRF_TOKEN' + CSRF_TOKEN);
                    },

                });
            }
        });
        
        $('#btnSavePatientForm').on('click', function () {
            $('#formSaveNewPatient').validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },

                messages: {
                    first_name: "Please enter the first name",
                    last_name: "Please enter the last name",
                    address: "Please enter the address",
                    email: "Please enter the email"
                }
            });
        });

        var tableAllPatientsGlob = '';

        // load the data to table
        function cicleDataPatientsAjax(data) {

            tableAllPatientsGlob =
            $('#tableAllPatients').DataTable( {
                processing: true,
                serverSide: true,
                ajax: urlAllPatients,
                columns: [
                    { data: 'id_patient', name: 'id_patient' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'company_name', name: 'company_name' },
                    { data: 'address', name: 'address' },
                    { data: 'city', name: 'city' },
                ]
            } );
        }

        $('#tableAllPatients tbody').on( 'click', 'tr', function () {
            var table = $('#tableAllPatients').DataTable();

            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $.each($("#tableAllPatients tr.selected"),function(){
                    id = $(this).find('td').eq(0).text();
                    $('#searchModal').modal('hide');

                    formFillUpAllFields(id, allPatientsDataGlob);
                });
            //    console.log(id);
            }
        });

    });

    function formFillUpAllFields(id, allPatientData) {

        var listPatientData = allPatientData.data;

        $.each(listPatientData, function( key, value ) {
            if (value.id_patient === id) {
                console.log(value);

                $('#id_patient_hidden').val( value.id_patient );
                $('#first_name').val( value.first_name );
                $('#last_name').val( value.last_name );
                $('#address').val( value.address );
                $('#email').val( value.email );
                $('div.divNation select').val( value.nation );
                $('div.divCity select').val( value.city );
                $('div.divAdult select').val( value.adult_child );
                $('div.divSex select').val( value.sex );
                $('#zip_code').val( value.zip_code );
                $('#tax_code').val( value.tax_code );
                $('#date_birth').val( value.date_birth );

            }
        });



    }

</script>

@endsection