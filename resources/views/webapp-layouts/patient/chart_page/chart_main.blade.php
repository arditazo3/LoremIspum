@extends('layouts.admin',
    ['title'=> 'Chart Panel', 'subTitle'=>'Chart Page',
     'activeOpen'=> 'PatientPanel', 'activeOpenSub'=> 'ChartPage',
     'website'=>\App\Option::findOrFail(1)->value])

@section('myCSS')
    @include('includes.myCSS.toastr')
    @include('includes.myCSS.datatablesCSS')
    @include('includes.myCSS.sweetalertCSS')
    @include('includes.myCSS.fullcalendarCSS')
    @include('includes.myCSS.patientDataCSS')
    @include('includes.myCSS.jsTreeCSS')
    @include('includes.myCSS.icheckCSS')
@endsection

@section('content')

            @if(\Illuminate\Support\Facades\Session::has('deleted_patient'))
                @include('includes.notification-alert', ['alert_type'=> 'danger', 'msg'=> session('deleted_patient')])
            @elseif(\Illuminate\Support\Facades\Session::has('updated_patient'))
                @include('includes.notification-alert', ['alert_type'=> 'warning', 'msg'=> session('updated_patient')])
            @elseif(\Illuminate\Support\Facades\Session::has('created_patient'))
                @include('includes.notification-alert', ['alert_type'=> 'success', 'msg'=> session('created_patient')])
            @endif

        {{-- LIST CHART MODAL --}}
        @include('includes.myPieces.patient.list_charts_modal_patient')
        {{-- END LIST CHART MODAL --}}

        {{-- CHART MODAL --}}
        @include('includes.myPieces.patient.charts_patient', ['isPage' => true])
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
    @include('includes.myScript.icheckJS')
    @include('includes.myScript.custom_script.myCustomScriptJS')

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
        var checkIfPatientHasChartAjax = '{{ route('api/checkIfPatientHasChart') }}';
        var createNewChart = '{{ route('api/createNewChart') }}';



    </script>

{{--
-- HERE IS THE LOGIC FOR 'NEW/EDIT CURE'
--}}
@include('includes.myScript.patient.curePatientJS')

{{--
-- HERE IS THE LOGIC FOR 'TEETH CHART PATIENT'
--}}
@include('includes.myScript.patient.teethChartPatientListCureJS')


@endsection