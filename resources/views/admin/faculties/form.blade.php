@extends('layouts.admin.main')
@if($faculty->id)
@section('title-page', __('lang.title.update-faculty'))
@else
@section('title-page', __('lang.title.create-faculty'))
@endif
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        @if($faculty->id)
                        <h5>@lang('lang.faculties.form.create.title')</h5>
                        @else
                        <h5>@lang('lang.faculties.form.update.title')</h5>
                        @endif
                    </div>
                    <div class="card-body">
                        @if($faculty->id)
                        {{ Form::model($faculty, array('method' => 'PUT', 'route' => array('faculties.update', $faculty->id))) }}
                        @else
                        {{ Form::model($faculty, ['method' => 'POST', 'route' => 'faculties.store', 'class' => 'theme-form']) }}
                        @endif
                        <div class="mb-3">
                            {{ Form::label('exampleInputEmail1', __('lang.faculties.form.title.input.name'), ['class' => 'col-form-label pt-0']) }}
                            @if ($errors->first('name'))
                            {!!Form::text('name', $faculty->name, ['class' => 'form-control is-invalid' , 'id' => 'exampleInputEmail1','placeholder' => __('lang.faculties.form.placeholder.input.name')])!!}
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @else
                            {{ Form::text('name', $faculty->name, array('class'=>'form-control','id' => 'exampleInputEmail1','placeholder' => __('lang.faculties.form.placeholder.input.name'))) }}
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit(__('lang.faculties.form.btn-save'), ['class' => 'btn btn-primary']) !!}
                        {{ Form::close() }}
                        @if($faculty->id)
                        <a href="{{route('faculties.destroy',$faculty->id)}}" class="btn btn-danger btnDelete">@lang('lang.faculties.form.btn-delete')</a>
                        @endif
                        <form action="" method="POST" id="form-delete">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $('.btnDelete').click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        $('#form-delete').attr('action', href);
        if (confirm('Are you sure?')) {
            $('#form-delete').submit();
        }
    });
</script>
@endsection