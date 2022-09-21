@extends('layouts.admin.main')
@section('title-page', 'List students')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>List student</h5>
                    <form class="row theme-form mt-3" action="{{route('students.index')}}" method="GET">
                        <div class="col-xxl-4 mb-3 d-flex">
                            <label class="col-form-label pe-2" for="inputInlineUsername">From</label>
                            <input class="form-control" id="inputInlineUsername" type="number" name="age_from" placeholder="From" autocomplete="off">
                        </div>
                        <div class="col-xxl-4 mb-3 d-flex">
                            <label class="col-form-label pe-2" for="inputInlinePassword">To</label>
                            <input class="form-control" id="inputInlinePassword" type="number" name="age_to" placeholder="To" autocomplete="off">
                        </div>
                        <div class="col-xxl-4 mb-3 d-flex">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </form>
                    <button data-bs-target="#create-bookmark" data-bs-toggle="modal" class="btn btn-primary mt-3 mb-3 btn-create">Create</button>
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
                                <th scope="col">Mark Average</th>
                                <th scope="col">Status</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr id="id{{$student->id}}">
                                <th scope="row">{{$student->id}}</th>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td><img width="100px" src="{{asset('img/profiles/' . $student->avatar)}}"></td>
                                @if($student->subjects->count() == $subject->count())
                                <td>{{round($student->subjects->avg('pivot.mark'),2)}}</td>
                                @else
                                <td>Khong có đâu</td>
                                @endif
                                @if($student->subjects->count() !== $subject->count())
                                <td><a href="/alert-subject/{{$student->id}}" class="btn btn-danger btn-xs"><i class="fa-solid fa-bell"></i></a></td>
                                @else
                                <td><button class="btn btn-primary btn-xs"><i class="fa-solid fa-check"></i></button></td>
                                @endif
                                <td>
                                    <button class="btn btn-warning btn-xs btnModal" data-id="{{$student->id}}" data-bs-target="#edit-bookmark" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger btn-xs btnDelete" data-id="{{$student->id}}" id="deleteStudent"><i class="fa-solid fa-trash"></i></button>
                                    @if($student->subjects->count() === $subject->count())
                                    <a href="/add-mark/{{$student->id}}" class="btn btn-primary btn-xs"><i class="fa-solid fa-eye"></i></a>
                                    <button class="btn btn-secondary btn-xs" data-id="{{$student->id}}" data-bs-target="#edit-bookmark" data-bs-toggle="modal"><i class="fa-solid fa-book"></i></button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="/alert-subject" method="GET" id="form-alert"> </form>
        <a href="/alert-subject" id="alert-subject-btn" onclick="return confirm('Do you want send to student?')" class="btn btn-primary float-end">Send <i class="fas fa-paper-plane"></i></a>
    </div>
</div>

<div class="modal fade modal-bookmark" id="create-bookmark" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Student</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::model($student, ['method' => 'POST']) }}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Name student')!!}
                        @if ($errors->first('name'))
                        {!!Form::text('name', '',['class' => 'form-control is-invalid' ,'id' => 'name_student','placeholder' => 'Enter name student'])!!}
                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @else
                        {!! Form::text('name', '', ['class' => 'form-control','id' => 'name_student','placeholder' => 'Enter name student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Email student')!!}
                        @if ($errors->first('email'))
                        {!!Form::email('email', '',['class' => 'form-control is-invalid' ,'id' => 'email_student','placeholder' => 'Enter email student'])!!}
                        <div class="invalid-feedback">{{$errors->first('email')}}</div>
                        @else
                        {!! Form::email('email', '', ['class' => 'form-control','id' => 'email_student','placeholder' => 'Enter name student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Phone number student')!!}
                        @if ($errors->first('phone'))
                        {!!Form::text('phone', '',['class' => 'form-control is-invalid' ,'id' => 'phone_student','placeholder' => 'Enter phone student'])!!}
                        <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                        @else{!! Form::text('phone', '', ['class' => 'form-control','id' => 'phone_student','placeholder' => 'Enter phone student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Birthday student')!!}
                        @if ($errors->first('birthday'))
                        {!!Form::date('birthday', '',['class' => 'form-control is-invalid' ,'id' => 'birthday_student','placeholder' => 'Enter birthday student'])!!}
                        <div class="invalid-feedback">{{$errors->first('birthday')}}</div>
                        @else{!! Form::date('birthday', '', ['class' => 'form-control','id' => 'birthday_student','placeholder' => 'Enter birthday student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Address student')!!}
                        @if ($errors->first('address'))
                        {!!Form::text('address', '',['class' => 'form-control is-invalid' ,'id' => 'address_student','placeholder' => 'Enter address student'])!!}
                        <div class="invalid-feedback">{{$errors->first('address')}}</div>
                        @else{!! Form::text('address', '', ['class' => 'form-control','id' => 'address_student','placeholder' => 'Enter address student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('', 'Gender', ['class' => 'col-form-label pt-0']) }}
                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                            @if ($errors->first('gender'))
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '0', true, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline11'])}}
                                {{ Form::label('radioinline11', 'Male', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '1', false, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline22'])}}
                                {{ Form::label('radioinline22', 'Female', ['class' => 'mb-0']) }}
                            </div>
                            <div class="invalid-feedback">{{$errors->first('gender')}}</div>
                            @else
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '0', true, ['class' => 'form-check-input', 'id' => 'radioinline11'])}}
                                {{ Form::label('radioinline11', 'Male', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '1', false, ['class' => 'form-check-input', 'id' => 'radioinline22'])}}
                                {{ Form::label('radioinline22', 'Female', ['class' => 'mb-0']) }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::submit('Save', ['class' => 'btn btn-secondary','id' => 'saveCreateForm'])!!}
                {!! Form::button('Cancel', ['class' => 'btn btn-primary','data-bs-dismiss' => 'modal'])!!}
                {!! Form::close() !!}
            </div>
            {!!Form::hidden('student_id', '',['id' => 'student_id'])!!}
            {!!Form::hidden('user_id', '',['id' => 'user_id'])!!}
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
                {{ Form::model($student, ['method' => 'POST']) }}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Name student')!!}
                        @if ($errors->first('name'))
                        {!!Form::text('name', '',['class' => 'form-control is-invalid' ,'id' => 'name_student_edit','placeholder' => 'Enter name student'])!!}
                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @else{!! Form::text('name', '', ['class' => 'form-control','id' => 'name_student_edit','placeholder' => 'Enter name student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Phone number student')!!}
                        @if ($errors->first('phone'))
                        {!!Form::text('phone', '',['class' => 'form-control is-invalid' ,'id' => 'phone_student_edit','placeholder' => 'Enter phone student'])!!}
                        <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                        @else{!! Form::text('phone', '', ['class' => 'form-control','id' => 'phone_student_edit','placeholder' => 'Enter phone student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Birthday student')!!}
                        @if ($errors->first('birthday'))
                        {!!Form::date('birthday', '',['class' => 'form-control is-invalid' ,'id' => 'birthday_student_edit','placeholder' => 'Enter birthday student'])!!}
                        <div class="invalid-feedback">{{$errors->first('birthday')}}</div>
                        @else{!! Form::date('birthday', '', ['class' => 'form-control','id' => 'birthday_student_edit','placeholder' => 'Enter birthday student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', 'Address student')!!}
                        @if ($errors->first('address'))
                        {!!Form::text('address', '',['class' => 'form-control is-invalid' ,'id' => 'address_student_edit','placeholder' => 'Enter address student'])!!}
                        <div class="invalid-feedback">{{$errors->first('address')}}</div>
                        @else{!! Form::text('address', '', ['class' => 'form-control','id' => 'address_student_edit','placeholder' => 'Enter address student']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('faculty_id', 'Faculty', ['class' => 'col-form-label col-sm-3 pt-0']) }}
                        {!!Form::select('faculty_id', $faculties,'', ['id' => 'faculty_id_edit', 'class' => 'form-select digits'])!!}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('', 'Gender', ['class' => 'col-form-label pt-0']) }}
                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                            @if ($errors->first('gender'))
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '0', true, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline11_edit'])}}
                                {{ Form::label('radioinline11', 'Male', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '1', false, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline22_edit'])}}
                                {{ Form::label('radioinline22', 'Female', ['class' => 'mb-0']) }}
                            </div>
                            <div class="invalid-feedback">{{$errors->first('gender')}}</div>
                            @else
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '0', true, ['class' => 'form-check-input', 'id' => 'radioinline11_edit'])}}
                                {{ Form::label('radioinline11', 'Male', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '1', false, ['class' => 'form-check-input', 'id' => 'radioinline22_edit'])}}
                                {{ Form::label('radioinline22', 'Female', ['class' => 'mb-0']) }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('', 'Status', ['class' => 'col-form-label pt-0']) }}
                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                            @if ($errors->first('status'))
                            <div class="radio radio-primary">
                                {{Form::radio('status', '0', true, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline1_edit'])}}
                                {{ Form::label('radioinline1_edit', 'Show', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('status', '1', false, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline2_edit'])}}
                                {{ Form::label('radioinline2_edit', 'Female', ['class' => 'mb-0']) }}
                            </div>
                            <div class="invalid-feedback">{{$errors->first('status')}}</div>
                            @else
                            <div class="radio radio-primary">
                                {{Form::radio('status', '0', true, ['class' => 'form-check-input', 'id' => 'radioinline1_edit'])}}
                                {{ Form::label('radioinline1_edit', 'Off', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('status', '1', false, ['class' => 'form-check-input', 'id' => 'radioinline2_edit'])}}
                                {{ Form::label('radioinline2_edit', 'Show', ['class' => 'mb-0']) }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::submit('Save', ['class' => 'btn btn-secondary','id' => 'saveUpdateForm'])!!}
                {!! Form::button('Cancel', ['class' => 'btn btn-primary','data-bs-dismiss' => 'modal'])!!}
                {!! Form::close() !!}
            </div>
            {!!Form::hidden('student_id', '',['id' => 'student_id'])!!}
            {!!Form::hidden('user_id', '',['id' => 'user_id'])!!}
        </div>
    </div>
</div>
<div class="modal fade modal-bookmark" id="subject-bookmark" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List subjects</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-border-vertical" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody id="table-subject">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    // Edit popup ajax
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('.btnModal').on('click', function() {
        var id = $(this).attr('data-id');
        var url = 'students/' + id + '/edit';
        $.ajax({
            method: "GET",
            dataType: "json",
            url: 'students/' + id + '/edit',
            success: function(data) {
                $('#name_student_edit').val(data.name);
                $('#phone_student_edit').val(data.phone);
                $('#birthday_student_edit').val(data.birthday);
                $('#address_student_edit').val(data.address);
                $('#student_id').val(data.id);
                $("select[name=faculty_id] option[value= " + data.faculty_id + "]").prop('selected', 'selected');
            }
        })
    });

    $('#saveUpdateForm').on('click', function(event) {
        event.preventDefault();
        var name = $('#name_student_edit').val();
        var id = $('#student_id').val();
        var phone = $('#phone_student_edit').val();
        var birthday = $('#birthday_student_edit').val();
        var address = $('#address_student_edit').val();
        var gender = $('input[name="gender"]:checked').val();
        var faculty_id = $('select[name=faculty_id] option:selected').val();
        console.log(faculty_id);
        $.ajax({
            url: "/students/" + id,
            type: "PUT",
            data: {
                id: id,
                name: name,
                phone: phone,
                birthday: birthday,
                address: address,
                faculty_id: faculty_id,
                gender: gender
            },
            dataType: 'json',
            success: function(data) {
                Swal.fire(
                    'Successful!',
                    'Student update successfully!',
                    'success'
                )
                $('.modal-backdrop').removeClass('modal-backdrop');
                $('#edit-bookmark').removeAttr('style');
                $('#id' + data.student.id).find("td:eq(0)").text(data.student.name);
            }
        })
    });

    $('#saveCreateForm').on('click', function(event) {
        event.preventDefault();
        var name = $('#name_student').val();
        var email = $('#email_student').val();
        console.log(email);
        var phone = $('#phone_student').val();
        var birthday = $('#birthday_student').val();
        var address = $('#address_student').val();
        var gender = $('input[name="gender"]:checked').val();
        $.ajax({
            url: "{{route('students.store')}}",
            type: "POST",
            cache: false,
            data: {
                name: name,
                email: email,
                phone: phone,
                birthday: birthday,
                address: address,
                gender: gender
            },
            dataType: 'json',
            success: function(data) {
                Swal.fire(
                    'Successful!',
                    'Create student successfully!',
                    'success'
                )
                $('#create-bookmark').removeAttr('style');
                $('#edit-bookmark').css('padding-right', ' ');
                $('.modal-backdrop').removeClass('show');
                $('body').removeAttr("style");
                $('body').removeClass('modal-open');
                // window.location = "/students/";
            }
        })
    });

    //Delete ajax
    $("#deleteStudent").click(function() {
        var id = $(this).data("id");
        var token = $(this).data("token");
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "students/" + id,
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function(data) {
                    Swal.fire(
                        'Successful!',
                        'Student delete successfully!',
                        'success'
                    )
                    $('#id' + data.student.id).remove();
                }
            });
        }
    });

    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endsection
@endsection