@extends('layouts.admin.main')
@section('title-page', 'Create new student')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Create new student</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::model($student, ['enctype' => 'multipart/form-data', 'method' => 'POST', 'route' => 'students.store', 'class' => 'theme-form']) }}
                        <div class="mb-3">
                            {{ Form::label('exampleInputNameStd', 'Name student', ['class' => 'col-form-label pt-0']) }}
                            @if ($errors->first('name'))
                            {!!Form::text('name', $student->name, ['class' => 'form-control is-invalid' , 'id' => 'exampleInputNameStd','placeholder' => 'Enter name student'])!!}
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @else
                            {{ Form::text('name', $student->name, array('class'=>'form-control','id' => 'exampleInputNameStd','placeholder' => 'Enter name student')) }}
                            @endif
                        </div>
                        <div class="mb-3">
                            {{ Form::label('exampleInputEmail1', 'Email student', ['class' => 'col-form-label pt-0']) }}
                            @if ($errors->first('email'))
                            {!!Form::email('email', $student->email, ['class' => 'form-control is-invalid' , 'id' => 'exampleInputEmail1','placeholder' => 'Enter email student'])!!}
                            <div class="invalid-feedback">{{$errors->first('email')}}</div>
                            @else
                            {{ Form::email('email', $student->email, array('class'=>'form-control','id' => 'exampleInputEmail1','placeholder' => 'Enter email student')) }}
                            @endif
                        </div>
                        <fieldset class="mb-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ Form::label('', 'Gender', ['class' => 'col-form-label pt-0']) }}
                                </div>
                                <div class="col">
                                    <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                        @if ($errors->first('gender'))
                                        <div class="radio radio-primary">
                                            {{Form::radio('gender', '0', true, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline1'])}}
                                            {{ Form::label('radioinline1', 'Male', ['class' => 'mb-0']) }}
                                        </div>
                                        <div class="radio radio-primary">
                                            {{Form::radio('gender', '1', false, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline2'])}}
                                            {{ Form::label('radioinline2', 'Female', ['class' => 'mb-0']) }}
                                        </div>
                                        <div class="invalid-feedback">{{$errors->first('gender')}}</div>
                                        @else
                                        <div class="radio radio-primary">
                                            {{Form::radio('gender', '0', true, ['class' => 'form-check-input', 'id' => 'radioinline1'])}}
                                            {{ Form::label('radioinline1', 'Male', ['class' => 'mb-0']) }}
                                        </div>
                                        <div class="radio radio-primary">
                                            {{Form::radio('gender', '1', false, ['class' => 'form-check-input', 'id' => 'radioinline2'])}}
                                            {{ Form::label('radioinline2', 'Female', ['class' => 'mb-0']) }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        {!! Form::hidden('avatar','https://lionsyouthbrass.band/wp-content/uploads/2022/05/Profile.jpg')!!}
                        {!! Form::hidden('phone','099999999')!!}
                        {!! Form::hidden('birthday', date('Y-m-d'))!!}
                        {!! Form::hidden('address', 'Your address')!!}
                        {!! Form::hidden('status', 0)!!}
                        {!! Form::hidden('password', '1')!!}
                    </div>
                </div>
                <div class="card-footer">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    // Tag
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>
@endsection