@extends('layouts.admin',
    ['title'=> 'Patient Panel', 'subTitle'=>'New Patient',
     'activeOpen'=> 'PatientPanel', 'activeOpenSub'=> 'NewPatient',
     'website'=>\App\Option::findOrFail(1)->value])

@section('myCSS')
    @include('includes.myCSS.toastr')
    @include('includes.myCSS.datatablesCSS')
    @include('includes.myCSS.sweetalertCSS')
    @include('includes.myCSS.fullcalendarCSS')
    @include('includes.myCSS.patientDataCSS')
    @include('includes.myCSS.jsTreeCSS')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">

            @if(\Illuminate\Support\Facades\Session::has('deleted_patient'))
                @include('includes.notification-alert', ['alert_type'=> 'danger', 'msg'=> session('deleted_patient')])
            @elseif(\Illuminate\Support\Facades\Session::has('updated_patient'))
                @include('includes.notification-alert', ['alert_type'=> 'warning', 'msg'=> session('updated_patient')])
            @elseif(\Illuminate\Support\Facades\Session::has('created_patient'))
                @include('includes.notification-alert', ['alert_type'=> 'success', 'msg'=> session('created_patient')])
            @endif

            {{--START FORM--}}
            {!! Form::open(['method'=>'POST', 'action'=>'PatientController@createUpdatePatientAjax', 'role'=>'form',
                'id'=>'formSaveNewPatient', 'files'=>true]) !!}

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Fill up the patient form</h5>
                    <div class="ibox-tools">

                        <button class="btn btn-info btn-sm" type="button" id="btnNewCare"><i class="fa fa-plus"></i>
                            New Care
                        </button>

                        <button class="btn btn-primary btn-sm" type="button" id="btnCharts"><i class="fa fa-folder-open"></i>
                            Charts
                        </button>

                        <span class="vr-line-solid"></span>

						<button type="button" class="btn btn-warning btn-sm" id="btnRestorePatient">
                            Restore form
                        </button>
					
                        <button type="button" class="btn btn-danger btn-sm" id="btnDeletePatient">
                            <i class="fa fa-remove"></i> Delete patient
                        </button>

                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#searchModal"
                                data-backdrop="static" data-keyboard="false" id="searchPatientsModal">
                            <i class="fa fa-search"></i> Search
                        </button>

                        {!! Form::submit('Save patient', ['class'=>'btn btn-success btn-sm', 'id'=>'btnSavePatientForm']) !!}

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
                                <img id="imageFile" src="{{ $patient->image ? ($website . $patient->image->path) : ($website . 'img/user-no_photo.png')}}"
                                     class="img-responsive" alt="" style="max-width: 200px; max-height: 150px;">
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
                                         src="{{ $website . 'img/user-no_photo.png' }}"
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

                                    <button type="button" class="btn btn-w-m btn-white btn-sm" id="btnBackProfilePicture">
                                        Don't change
                                    </button>
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-5 b-r">
                            <input type="hidden" id="id_patient_hidden" name="id_patient" />
                            <input type="hidden" id="call_cure_modal_from_chart" />
                            <input type="hidden" id="call_refresh_list_cures_from_cureDetail_to_chart" />
                            <input type="hidden" id="call_delete_cure_from_teethChart_to_cure" />

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
                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group ">
                                                {!! Form::label('date_birth', 'Birth date', ['class'=>'control-label']) !!}

                                                <div class="form-group" id="data_1">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-calendar"></i></span>
                                                        <input class="datepicker form-control" data-date-format="dd/mm/yyyy" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"
                                                                id="date_birth" name="date_birth" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('birth_place', 'Birth place', ['class'=>'control-label']) !!}
                                                <div class="divBirthPlace">
                                                    {!! Form::select('birth_place', ['0'=>'Select...'] + $cities, null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group ">
                                                {!! Form::label('marital_status', 'Marital status', ['class'=>'control-label']) !!}
                                                <div class="divMaritalStatus">
                                                    {!! Form::select('marital_status', ['0'=>'Select...'] + $marital_status, null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                {!! Form::label('language', 'Language', ['class'=>'control-label']) !!}
                                                <div class="divLanguage">
                                                    {!! Form::select('language', ['0'=>'Select...'] + $languages, null, ['class'=>'form-control']) !!}
                                                </div>
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
                                                <div class="divProffession">
                                                    {!! Form::select('proffession', ['0'=>'Select...'] + $proffessions, null, ['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>

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
                            <div class="panel panel-info" id="panel2">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-target="#collapseTwo"
                                           href="#collapseTwo" class="collapsed">
                                            Controls
                                        </a>
                                    </h4>

                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        {{--Controls--}}
                                        <div class="col-sm-6 b-r">
                                            <div class="form-group" id="divNoControlUtilNow">
                                                <div class="alert alert-warning">
                                                    <b>No appointment registred util now.</b>
                                                </div>
                                            </div>

                                            <div class="form-group" id="divFirstControl">
                                                {!! Form::label('date_first_visit', 'First control', ['class'=>'control-label']) !!}
                                                {!! Form::text('date_first_visit', null, ['class'=>'form-control', 'placeholder'=>'',
                                                                'disabled']) !!}
                                            </div>

                                            <div class="form-group" id="divLastControl">
                                                {!! Form::label('date_last_visit', 'Last control', ['class'=>'control-label']) !!}
                                                {!! Form::text('date_last_visit', null, ['class'=>'form-control', 'placeholder'=>'',
                                                                'disabled']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-6 b-r">
                                            <div class="form-group" id="divNextControl">
                                                {!! Form::label('date_next_visit', 'Next control', ['class'=>'control-label']) !!}
                                                {!! Form::text('date_next_visit', null, ['class'=>'form-control', 'placeholder'=>'',
                                                                'disabled']) !!}
                                            </div>

                                            <div class="form-group" id="divPatientAppoitments">
                                                <button type="button" class="btn btn-w-m btn-success btn-block"
                                                 id="btnAppointmentsForThisClient">
                                                    <i class="fa fa-calendar"></i> Create an appointment of this client </button>

                                            </div>
                                        </div>
                                        {{--End Controls--}}

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

    {{-- AGENDA MODAL --}}
    @include('includes.myPieces.calendar.main_calendar_modal')
    {{--END AGENDA MODAL--}}

    {{-- CHART MODAL --}}
    @include('includes.myPieces.patient.charts_patient')
    {{-- END CHART MODAL --}}

    {{-- CURE MODAL --}}
    @include('includes.myPieces.patient.cure_patient',
    ['listCures'=> $listCures, 'typeCure'=> $typeCure, 'statusCure'=> $statusCure, 'listUsers'=> $listUsers, 'website'=>$website ])
    {{-- END CURE MODAL --}}

    {{--MODAL NOTIFICATION ERROR--}}
    @include('includes.myPieces.modal.modal_notification_msg', ['typeMsg'=>'danger'])

@endsection

@section('myScript')

    @include('includes.myScript.datatablesJS')
    @include('includes.myScript.fullcalendarJS')
    @include('includes.myScript.toastr')
    @include('includes.myScript.jquery_validate')
    @include('includes.myScript.sweetalertJS')
    @include('includes.myScript.jsTreeJS')

<script>

    {{-- HERE ARE GLOBAL VARIABLES TO BE ACCESSED FROM ANOTHER JS SCRIPTS --}}
    var token = '{{ \Illuminate\Support\Facades\Session::token() }}';
    var controlsInfo = '{{ route('api/getInfoControlPatient') }}';
    var urlCreateEvent = '{{ route('api/createEventAjax') }}';
    var selectedCure = '{{ route('api/getSelectedCure') }}';
    var oldTimeGlob = '{{ old('time') }}';
    var urlSaveUpdateCure = '{{ route('api/saveUpdateCureAjax') }}';
    var urlDeleteCure = '{{ route('api/deleteCureAjax') }}';
    var getListCuresByPatient = '{{ route('api/getListCuresByPatient') }}';

    {{--
    -- HERE IS THE LOGIC ONLY FOR MAIN MECHANISM AND 'PATIENT DATA'
    --}}
    $(document).ready(function () {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        token = '{{ \Illuminate\Support\Facades\Session::token() }}';
        var allPatientsDataGlob = '';
        var urlAllPatients = '{{ route('api/allPatientsAjax') }}';
        var urlDeletePatient = '{{ route('api/deletePatientAjax') }}';

        var $btnDeleteGlob = $('#btnDeletePatient').hide();
        var $btnChartsGlob = $('#btnCharts').hide();
        var $btnNewCareGlob = $('#btnNewCare').hide();

        var changeProfPicGlob = $('#changeProfilePicture').hide();
        var defaultProfPicGlob = $('#defaultProfilePicture').show();
        var confirmPasswordGlob = $('#divComfirmPassword').hide();
        var noClickOnSingleOperation = 0;

        var selectedCureOpenModal = '';

        // Open list of patient when button is clicked
        $('#searchPatientsModal').click(function () {

            noClickOnSingleOperation++;

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
                        // console.log(data);
                        allPatientsDataGlob = data;
                        cicleDataPatientsAjax(data);
                        noClickOnSingleOperation = 0;
                    },
                    error: function () {
                        console.log('Error' + url);
                        console.log('CSRF_TOKEN' + CSRF_TOKEN);
                        noClickOnSingleOperation = 0;
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

                    restoreAllFields();

                    formFillUpAllFields(id, allPatientsDataGlob, $btnDeleteGlob, $btnChartsGlob, $btnNewCareGlob);
                });
            }
        });

        $('#btnChangeProfilePicture').click(function () {

            changeProfPicGlob.show();0
            defaultProfPicGlob.hide();
        });

        $('#btnBackProfilePicture').click(function () {

            changeProfPicGlob.hide();
            defaultProfPicGlob.show();
        });

        // Delete the patient
        $('#btnDeletePatient').click(function () {

            var fullName = $('#first_name').val() + ' ' + $('#last_name').val();

            swal({ title: "Delete patient: " + fullName,
                        text: "Are you sure to delete this patient?",
                        type: "error",   showCancelButton: true,
                        confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: true },

				function(){
					$.ajax({
						method: 'POST',
						url: urlDeletePatient,
						data: {
							id_patient: $('#id_patient_hidden').val(),
							_token:     token
						}
					})
					.error(function (msg) {
						console.log(JSON.stringify(msg));
					})
					.done(function (msg) {
						// refresh the page if the actions was successfully
						if(msg.status === 'DELETED')
							location.reload();

				});
            });
        });
		
		// Restore the patient
		$('#btnRestorePatient').click(function () {
			restoreAllFields();
            $btnDeleteGlob.hide();
            $btnChartsGlob.hide();
            $btnNewCareGlob.hide();
            console.log('Restored Main and Personal data fields');
		});

    });

    function formFillUpAllFields(id, allPatientData, $btnDeleteGlob, $btnChartsGlob, $btnNewCareGlob) {

        var listPatientData = allPatientData.data;

        $.each(listPatientData, function( key, value ) {
            if (value.id_patient === id) {
                console.log(value);

                $('#id_patient_hidden').val( value.id_patient );
                $('#id_patient_hidden').trigger('change');
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

                var datepicker = $('#date_birth');
                datepicker.datepicker({ dateFormat: "dd-mm-YY" });
                datepicker.datepicker('setDate', changeFormatDate( value.date_birth ) );

                $('div.divProffession select').val( value.proffession );
                $('div.divMaritalStatus select').val( value.marital_status );
                $('div.divBirthPlace select').val( value.birth_place );
                $('div.divLanguage select').val( value.language );
                $('#personal_phone').val( value.personal_phone );
                $('#office_phone').val( value.office_phone );

                if(value.image_path != null && value.image_path.trim() != "")
                    $('#imageFile').attr('src', '{{ $website }}' + value.image_path );

            }
        });
        $btnDeleteGlob.show();
        $btnChartsGlob.show();
        $btnNewCareGlob.show();
    }

    function changeFormatDate(inputDate) {
        var date = new Date(inputDate);
        if (!isNaN(date.getTime())) {

            var day =  formatDigitsDate( date.getDate() );
            // Months use 0 index.
            var month =  formatDigitsDate( date.getMonth() + 1 );

            return day + '/' + month + '/' + date.getFullYear();
        }
    }

    function formatDigitsDate(inputDate) {

        if (inputDate < 10)
            return '0' + inputDate;
        else
            return inputDate;
    }
	
	function restoreAllFields() {
		
		$('#id_patient_hidden').val('');
		$('#first_name').val('');
		$('#last_name').val('');
		$('#address').val('');
		$('#email').val('');
		$('div.divNation select').val('');
		$('div.divCity select').val('');
		$('div.divAdult select').val('');
		$('div.divSex select').val('');
		$('#zip_code').val('');
		$('#tax_code').val('');

		var datepicker = $('#date_birth');
		datepicker.datepicker({ dateFormat: "dd-mm-YY" });
		datepicker.datepicker('setDate', changeFormatDate( Date.now() ) );

		$('div.divProffession select').val('0');
		$('div.divMaritalStatus select').val('0');
		$('div.divBirthPlace select').val('0');
		$('div.divLanguage select').val('0');
		$('div.divAdult select').val('0');
		$('div.divSex select').val('0');
		$('#personal_phone').val('');
		$('#office_phone').val('');

        $('#imageFile').attr('src', '{{ $website . 'img/user-no_photo.png' }}' );

        // Restore the Control Tab
        restoreControls();
	}

    function restoreControls() {
        $('#divFirstControl').hide();
        $('#divLastControl').hide();
        $('#divNextControl').hide();
        $('#divNoControlUtilNow').show();
        $('#divPatientAppoitments').hide();

        $('#date_first_visit').val( '' );
        $('#date_last_visit').val( '' );
        $('#date_next_visit').val( '' );


        console.log('Restore the Control tab');
    }

</script>

{{--
-- HERE IS THE LOGIC FOR 'CONTROLS'
--}}
@include('includes.myScript.patient.controlTabJS')

{{--
-- HERE IS THE LOGIC FOR 'NEW/EDIT CURE'
--}}
@include('includes.myScript.patient.curePatientJS')

{{--
-- HERE IS THE LOGIC FOR 'TEETH CHART PATIENT'
--}}
@include('includes.myScript.patient.teethChartPatientListCureJS')

@endsection