@extends('layouts.admin.main')
@section('title-page', 'List faculties')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>List faculties</h5>
                    @can('create')
                    <a href="{{route('faculties.create')}}"><button class="btn btn-primary mt-3">Create</button></a>
                    @endcan
                </div>
                @if (session()->has('success'))
                <div class="alert alert-primary w-50 ml-30">
                    <p class="font-light">{{ session()->get('success') }}</p>
                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger w-50 ml-30">
                    <p class="font-light">{{ session()->get('error') }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-border-vertical" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name faculty</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faculties as $faculty)
                            <tr id="id{{ $faculty->id }}">
                                <th scope="row">{{ $faculty->id }}</th>
                                <td>{{ $faculty->name }}</td>
                                @can('create')
                                <td>
                                    <a href="{{ route('faculties.edit', ['faculty' => $faculty->id]) }}">
                                        <button class="btn btn-warning btn-xs"><i class="fa-solid fa-pen-to-square"></i>s</button>
                                    </a>
                                    <a href="{{ route('faculties.destroy', ['faculty' => $faculty->id]) }}" class="btn btn-danger btn-xs btnDelete"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                @endcan
                                @role('student')
                                @if(!($userNow[0]->faculty_id))
                                <td>
                                    <form action="/register-faculty/{{$faculty->id}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-primary">Register</button>
                                    </form>
                                </td>
                                @elseif($userNow[0]->faculty_id == $faculty->id)
                                <td>Registered</td>
                                @break
                                @endif
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="" method="POST" id="form-delete">
                        {{ method_field('DELETE') }}
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
        <div class="dataTables_paginate paging_simple_numbers" id="basic-1_paginate">
            {!!$faculties->links()!!}
        </div>
    </div>
</div>
<div class="modal fade modal-bookmark" id="edit-bookmark" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bookmark</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model(array('url' => '', 'class' => 'form-bookmark needs-validation')) !!}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Name Faculty')!!}
                        @if ($errors->first('name'))
                        {!!Form::text('name', '', ['class' => 'form-control is-invalid', 'id' => 'nameFaculty'])!!}
                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @else
                        {!!Form::text('name', '', ['class' => 'form-control' , 'id' => 'nameFaculty'])!!}
                        @endif
                        {!!Form::hidden('faculty_id', '',['id' => 'faculty_id'])!!}
                    </div>
                </div>
                {!! Form::button('Save', ['class' => 'btn btn-secondary','id' => 'saveUpdateForm'])!!}
                {!! Form::button('Cancel', ['class' => 'btn btn-primary','data-bs-dismiss' => 'modal'])!!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@section('js')
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

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function update(id) {
        // var id = $(this).attr('data-id');
        $.get('faculties/' + id + '/edit', function(data) {
            $('#nameFaculty').val(data.faculty.name);
            $('#faculty_id').val(data.faculty.id);
        })
    };

    var id = $('#faculty_id').val()
    $('#saveUpdateForm').on('click', function(id) {
        saveUpdate(id);
    });

    function saveUpdate() {
        var name = $('#nameFaculty').val();
        var id = $('#faculty_id').val();
        var url = '/admin/faculties/'
        $.ajax({
            url: "/admin/faculties/" + id,
            type: "PUT",
            data: {
                id: id,
                name: name,
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                )
                $('#edit-bookmark').removeClass('show');
                $('#edit-bookmark').css('padding-right', ' ');
                $('body').removeAttr("style");
                $('body').removeClass('modal-open');
                console.log($('#id' + data.id + 'td:nth-child(0)'));
                $('#id' + data.id).find("td:eq(0)").text(data.name);
                $('body').removeAttr('data-bs-padding-right');
            }
        })
    }
</script>
@endsection
@endsection