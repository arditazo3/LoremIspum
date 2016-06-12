@extends('layouts.admin',
    ['title'=> 'Patient Panel', 'subTitle'=>'New Patient',
     'activeOpen'=> 'PatientPanel', 'activeOpenSub'=> 'NewPatient',
     'website'=>\App\Option::findOrFail(1)->value])


@section('content')

    <div class="row">
        <div class="col-lg-12">
            {{--START FORM--}}
            <form action="" role="form">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Fill the form to create a new patient</h5>
                        <div class="ibox-tools">

                            {!! Form::submit('Save patient', ['class'=>'btn btn-primary btn-sm']) !!}

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
                                <div class="form-group ">
                                    {!! Form::label('first_name', 'First name', ['class'=>'control-label']) !!}
                                    {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'First name']) !!}
                                </div>

                                <div class="form-group ">
                                    {!! Form::label('last_name', 'Last name', ['class'=>'control-label']) !!}
                                    {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Last name']) !!}
                                </div>

                                <div class="form-group ">
                                    {!! Form::label('address', 'Address', ['class'=>'control-label']) !!}
                                    {!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Address']) !!}
                                </div>

                            </div>

                            <div class="col-sm-3 b-r">
                                <div class="form-group ">
                                    {!! Form::label('nation', 'Country', ['class'=>'control-label']) !!}
                                    {!! Form::text('nation', null, ['class'=>'form-control', 'placeholder'=>'Country']) !!}
                                </div>

                                <div class="form-group ">
                                    {!! Form::label('city', 'City', ['class'=>'control-label']) !!}
                                    {!! Form::text('city', null, ['class'=>'form-control', 'placeholder'=>'City']) !!}
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
                                                    {!! Form::text('adult_child', null, ['class'=>'form-control', 'placeholder'=>'Adult / Child']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('sex', 'Sex', ['class'=>'control-label']) !!}
                                                    {!! Form::text('sex', null, ['class'=>'form-control', 'placeholder'=>'Sex']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('date_birth', 'Birth date', ['class'=>'control-label']) !!}
                                                    {!! Form::text('date_birth', null, ['class'=>'form-control', 'placeholder'=>'Birth date']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('birth_place', 'Birth place', ['class'=>'control-label']) !!}
                                                    {!! Form::text('birth_place', null, ['class'=>'form-control', 'placeholder'=>'Birth place']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('marital_status', 'Marital status', ['class'=>'control-label']) !!}
                                                    {!! Form::text('marital_status', null, ['class'=>'form-control', 'placeholder'=>'Marital status']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('language', 'Language', ['class'=>'control-label']) !!}
                                                    {!! Form::text('language', null, ['class'=>'form-control', 'placeholder'=>'Language']) !!}
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
                                                    {!! Form::text('proffession', null, ['class'=>'form-control', 'placeholder'=>'Proffession']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('personal_phone', 'Personal phone', ['class'=>'control-label']) !!}
                                                    {!! Form::text('personal_phone', null, ['class'=>'form-control', 'placeholder'=>'Personal phone']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('office_phone', 'Office phone', ['class'=>'control-label']) !!}
                                                    {!! Form::text('office_phone', null, ['class'=>'form-control', 'placeholder'=>'Office phone']) !!}
                                                </div>

                                                <div class="form-group ">
                                                    {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
                                                    {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
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
                                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high
                                            life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                                            cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                            helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                            proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard
                                            of them accusamus labore sustainable VHS.
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
                                        <div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high
                                            life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                                            cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                            helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                            proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard
                                            of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{--END FORM--}}

        </div>
    </div>

@endsection