@extends('layouts.admin.main')
@if($subject->id)
@section('title-page', __('lang.title.update-subject'))
@else
@section('title-page', __('lang.title.create-subject'))
@endif
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        @if($subject->id)
                        <h5>@lang('lang.subjects.form.update.title')</h5>
                        @else
                        <h5>@lang('lang.subjects.form.create.title')</h5>
                        @endif
                    </div>
                    <div class="card-body">
                        @if($subject->id)
                        {{ Form::model($subject, array('method' => 'PUT', 'route' => array('subjects.update', $subject->id))) }}
                        @else
                        {{ Form::model($subject, ['method' => 'POST', 'route' => 'subjects.store', 'class' => 'theme-form']) }}
                        @endif
                        <div class="mb-3">
                            {{Form::label('exampleInputEmail1', __('lang.subjects.form.title.input.name'), ['class' => 'col-form-label pt-0'])}}
                            @if ($errors->first('name'))
                            {!!Form::text('name', $subject->name,['class' => 'form-control is-invalid' , 'id' => 'exampleInputEmail1','placeholder' => __('lang.subjects.form.placeholder.input.name')])!!}
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @else
                            {!!Form::text('name', $subject->name, ['class' => 'form-control' , 'id' => 'exampleInputEmail1','placeholder' => __('lang.subjects.form.placeholder.input.name')])!!}
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit(__('lang.subjects.form.btn-save'), ['class' => 'btn btn-primary'])!!}
                        {{ Form::close() }}
                        @if($subject->id)
                        <a href="{{route('subjects.destroy',$subject->id)}}" class="btn btn-danger deleteSubject">@lang('lang.subjects.form.btn-delete')</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".deleteSubject").click(function() {
        var id = $(this).data("id");
        var token = $(this).data("token");
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "subjects/" + id,
                type: 'POST',
                dataType: "JSON",
                data: {
                    id: id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function(data) {
                    Swal.fire(
                        'Successful!',
                        'Subject delete successfully!',
                        'success'
                    )
                    $('#id' + data.subject.id).remove();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Something went wrong!',
                    })
                }
            });
        }
    });
</script>
@endsection