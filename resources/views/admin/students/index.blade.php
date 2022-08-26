@extends('layouts.admin.main')
@section('title-page', 'List students')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>List students</h5>
                    <a href="{{route('students.create')}}"><button class="btn btn-primary mt-3">Create</button></a>
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
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Address</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Status</th>
                                <th scope="col">Faculty</th>
                                <th scope="col" colspan="2">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr id="id{{$student->id}}">
                                <th scope="row">{{$student->id}}</th>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->avatar}}</td>
                                <td>{{$student->phone}}</td>
                                <td>{{$student->birthday}}</td>
                                <td>{{$student->address}}</td>
                                <td>{{$student->gender}}</td>
                                <td>{{$student->status}}</td>
                                <td>{{$student->faculty_id}}</td>
                                <td>
                                    <a href="{{route('students.edit',['student' => $student->id])}}" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    <a href="{{route('students.destroy',['student' => $student->id])}}" class="btn btn-danger btnDelete">Delete</a>
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
                <h5 class="modal-title">Edit Student</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '', 'class' => 'form-bookmark needs-validation')) !!}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Name student')!!}
                        @if ($errors->first('name'))
                        {!!Form::text('name', '',['class' => 'form-control is-invalid' ,'id' => 'namestudent','placeholder' => 'Enter name student'])!!}
                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @else{!! Form::text('name', '', ['class' => 'form-control','id' => 'namestudent','placeholder' => 'Enter name student']) !!}
                        @endif
                        {!!Form::hidden('student_id', '',['id' => 'student_id'])!!}
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
        $.get('students/' + id + '/edit', function(data) {
            $('#namestudent').val(data.student.name);
            $('#student_id').val(data.student.id);
        })
    };

    var id = $('#student_id').val()
    $('#saveUpdateForm').on('click', function(id) {
        saveUpdate(id);
    });

    function saveUpdate() {
        var name = $('#namestudent').val();
        var id = $('#student_id').val();
        var url = '/admin/students/'
        $.ajax({
            url: "/admin/students/" + id,
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