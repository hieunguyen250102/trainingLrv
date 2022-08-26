@extends('layouts.admin.main')
@section('title-page', 'Create new category')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Create new subject</h5>
                    </div>
                    <div class="card-body">
                    @if($subject->id)
                        {{ Form::model($subject, array('method' => 'PUT', 'route' => array('subjects.update', $subject->id))) }}
                        @else
                        {{ Form::model($subject, ['method' => 'POST', 'route' => 'subjects.store', 'class' => 'theme-form']) }}
                        @endif
                        <div class="mb-3">
                            {{Form::label('exampleInputEmail1', 'Name Subject', ['class' => 'col-form-label pt-0'])}}
                            @if ($errors->first('name'))
                            {!!Form::text('name', $subject->name,['class' => 'form-control is-invalid' , 'id' => 'exampleInputEmail1','placeholder' => 'Enter name subject'])!!}
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @else
                            {!!Form::text('name', $subject->name, ['class' => 'form-control' , 'id' => 'exampleInputEmail1','placeholder' => 'Enter name subject'])!!}
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary'])!!}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@endsection