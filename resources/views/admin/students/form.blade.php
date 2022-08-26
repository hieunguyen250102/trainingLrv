@extends('layouts.admin.main')
@section('title-page', 'Create new student')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
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
                            {{ Form::label('exampleInputEmail1', 'Name student', ['class' => 'col-form-label pt-0']) }}
                            @if ($errors->first('name'))
                            {!!Form::text('name', $student->name, ['class' => 'form-control is-invalid' , 'id' => 'exampleInputEmail1','placeholder' => 'Enter name student'])!!}
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @else
                            {{ Form::text('name', $student->name, array('class'=>'form-control','id' => 'exampleInputEmail1','placeholder' => 'Enter name student')) }}
                            @endif
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