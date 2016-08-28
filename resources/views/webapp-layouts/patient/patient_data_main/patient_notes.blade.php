<div class="row">

    <div class="col-sm-6 b-r">
        <div class="form-group ">
            {!! Form::label('note1', 'First note', ['class'=>'control-label']) !!}
            {!! Form::textarea('note1', null, ['class'=>'form-control',
                'rows'=>'3', 'placeholder'=>'Put the content here...']) !!}
            @include('includes.form-error-specify', ['field'=>'note1', 'typeAlert'=>'danger'])
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group ">
            {!! Form::label('note2', 'Second note', ['class'=>'control-label']) !!}
            {!! Form::textarea('note2', null, ['class'=>'form-control',
                'rows'=>'3', 'placeholder'=>'Put the content here...']) !!}
            @include('includes.form-error-specify', ['field'=>'note2', 'typeAlert'=>'danger'])
        </div>
    </div>

</div>

<div class="row">

    <div class="col-sm-6 b-r">
        <div class="form-group ">
            {!! Form::label('note3', 'Third note', ['class'=>'control-label']) !!}
            {!! Form::textarea('note3', null, ['class'=>'form-control',
                'rows'=>'3', 'placeholder'=>'Put the content here...']) !!}
            @include('includes.form-error-specify', ['field'=>'note3', 'typeAlert'=>'danger'])
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group ">
            {!! Form::label('note4', 'Fourth note', ['class'=>'control-label']) !!}
            {!! Form::textarea('note4', null, ['class'=>'form-control',
                'rows'=>'3', 'placeholder'=>'Put the content here...']) !!}
            @include('includes.form-error-specify', ['field'=>'note4', 'typeAlert'=>'danger'])
        </div>
    </div>

</div>