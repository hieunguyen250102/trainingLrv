@extends('layout.admin.main')
@section('title-page', 'Create new category')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Create new faculty</h5>
                    </div>
                    <div class="card-body">
                        @if($faculty->id)
                        {{ Form::model($faculty, array('method' => 'PUT', 'route' => array('faculties.update', $faculty->id))) }}
                        @else
                        {{ Form::model($faculty, ['method' => 'POST', 'route' => 'faculties.store', 'class' => 'theme-form']) }}
                        @endif
                        <div class="mb-3">
                            {{ Form::label('exampleInputEmail1', 'Name Faculty', ['class' => 'col-form-label pt-0']) }}
                            @if ($errors->first('name'))
                            {!!Form::text('name', $faculty->name, ['class' => 'form-control is-invalid' , 'id' => 'exampleInputEmail1','placeholder' => 'Enter name faculty'])!!}
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @else
                            {{ Form::text('name', $faculty->name, array('class'=>'form-control','id' => 'exampleInputEmail1','placeholder' => 'Enter name faculty')) }}
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