@extends('layout.admin.main')
@section('title-page', 'List faculties')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>List faculties</h5>
                    <a href="{{route('faculties.create')}}"><button class="btn btn-primary mt-3">Create</button></a>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-primary w-50 ml-30">
                    <p class="font-light">{{ session()->get('success') }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-border-vertical" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox checkbox-dark">
                                        <input id="solidAll" type="checkbox">
                                        <label for="solid"></label>
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Name faculty</th>
                                <th scope="col" colspan="2">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faculties as $faculty)
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-dark">
                                        <input id="solid" type="checkbox" value="{{$faculty->id}}">
                                        <label for="solid"></label>
                                    </div>
                                </td>
                                <th scope="row">{{$faculty->id}}</th>
                                <td>{{$faculty->name}}}</td>
                                <td>
                                    <a onclick="update(<?php echo $faculty->id ?>)" data-bs-toggle="modal" data-bs-target="#edit-bookmark" id="editFaculty" data-id="{{$faculty->id}}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('faculties.destroy',['faculty' => $faculty->id])}}" class="btn btn-danger btnDelete">Delete</a>
                                </td>
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
                <form class="form-bookmark needs-validation" novalidate="">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Name Faculty</label>
                            <input class="form-control" id="nameFaculty" name="name" type="text" required="" autocomplete="off" value="">
                        </div>
                    </div>
                    <input type="hidden" name="faculty_id" id="faculty_id">
                    <button class="btn btn-secondary" type="button" id="saveUpdateForm" onclick="saveUpdate()">Save</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel </button>
                </form>
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
        var name = $('#nameFaculty').val()
        var id = $('#faculty_id').val()
        $.ajax({
            url: "admin/faculties/" + id,
            type: "PUT",
            data: {
                id: id,
                name: name,
            },
            dataType: 'json',
            success: function(data) {

            }
        })
    }
</script>
@endsection
@endsection