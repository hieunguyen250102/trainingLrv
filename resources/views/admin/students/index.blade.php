@extends('layouts.admin.main')
@section('title-page', 'List students')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
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
                    <a href="{{route('students.create')}}"><button class="btn btn-primary mt-3 mb-3">Create</button></a>
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
                                <th scope="col" class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input id="checkAll" type="checkbox"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr id="id{{$student->id}}">
                                <th scope="row">{{$student->id}}</th>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td><img width="100px" src="{{$student->student->avatar}}"></td>
                                @if($student->subjects->count() == $subject->count())
                                <td>{{$student->subjects->avg('pivot.mark')}}</td>
                                @else
                                <td>Khong có đâu</td>
                                @endif
                                @if($student->subjects->count() !== $subject->count())
                                <td><button class="btn btn-danger btn-xs"><i class="fa-solid fa-bell"></i></button></td>
                                @else
                                <td><button class="btn btn-primary btn-xs"><i class="fa-solid fa-check"></i></button></td>
                                @endif
                                <td>
                                    <button class="btn btn-warning btn-xs btnModal" data-id="{{$student->id}}" data-bs-target="#edit-bookmark" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger btn-xs btnDelete" data-id="{{$student->id}}" id="deleteStudent"><i class="fa-solid fa-trash"></i></button>
                                    <a href="" class="btn btn-primary btn-xs"><i class="fa-solid fa-eye"></i></a>
                                </td>
                                @if($student->subjects->count() !== $subject->count())
                                {{ Form::model($student, ['route' => ['alert-subject'], 'method' => 'get'])}}
                                <td><input type="checkbox" name="listIds[]" value="{{$student->id}}"></td>
                                @else
                                <td><span class="title">Done</span></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <button type="submit" onclick="return confirm('Do you want send to student?')" class="btn btn-primary float-end">Send<i class="fas fa-paper-plane"></i></button>
        {{ Form::close()}}
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
                        {!!Form::text('name', '',['class' => 'form-control is-invalid' ,'id' => 'name_student','placeholder' => 'Enter name student'])!!}
                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @else{!! Form::text('name', '', ['class' => 'form-control','id' => 'name_student','placeholder' => 'Enter name student']) !!}
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
                        {{ Form::label('faculty_id', 'Faculty', ['class' => 'col-form-label col-sm-3 pt-0']) }}
                        {!!Form::select('faculty_id', $faculties,'', ['id' => 'faculty_id', 'class' => 'form-select digits'])!!}
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
                    <div class="form-group col-md-12">
                        {{ Form::label('', 'Status', ['class' => 'col-form-label pt-0']) }}
                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                            @if ($errors->first('status'))
                            <div class="radio radio-primary">
                                {{Form::radio('status', '0', true, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline1'])}}
                                {{ Form::label('radioinline1', 'Show', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('status', '1', false, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline2'])}}
                                {{ Form::label('radioinline2', 'Female', ['class' => 'mb-0']) }}
                            </div>
                            <div class="invalid-feedback">{{$errors->first('status')}}</div>
                            @else
                            <div class="radio radio-primary">
                                {{Form::radio('status', '0', true, ['class' => 'form-check-input', 'id' => 'radioinline1'])}}
                                {{ Form::label('radioinline1', 'Off', ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('status', '1', false, ['class' => 'form-check-input', 'id' => 'radioinline2'])}}
                                {{ Form::label('radioinline2', 'Show', ['class' => 'mb-0']) }}
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
        $('tbody').addClass('name');
        var id = $(this).attr('data-id');
        var url = 'students/' + id + '/edit';
        console.log(id);
        $.ajax({
            method: "GET",
            dataType: "json",
            url: 'students/' + id + '/edit',
            success: function(data) {
                $('#name_student').val(data.name);
                $('#phone_student').val(data.phone);
                $('#birthday_student').val(data.birthday);
                $('#address_student').val(data.address);
                $('#student_id').val(data.id);
                $("select[name=faculty_id] option[value= " + data.faculty_id + "]").prop('selected', 'selected');
            }
        })
    });

    $('#saveUpdateForm').on('click', function(event) {
        event.preventDefault();
        var id = $('#student_id').val();
        var name = $('#name_student').val();
        var id = $('#student_id').val();
        var phone = $('#phone_student').val();
        var birthday = $('#birthday_student').val();
        var address = $('#address_student').val();
        var gender = $('input[name="gender"]:checked').val();
        var faculty_id = $('select[name=faculty_id] option:selected').val();
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
                console.log(data);
                $('#edit-bookmark').removeClass('show');
                $('#edit-bookmark').css('padding-right', ' ');
                $('.modal-backdrop').removeClass('show');
                $('body').removeAttr("style");
                $('body').removeClass('modal-open');
                $('#id' + data.student.id).find("td:eq(0)").text(data.student.name);

                let male = '<td><i class="fa-solid fa-mars"></i></td>';
                let female = '<td><i class="fa-solid fa-venus"></i></td>';
                if (data.student.gender === 0) {
                    $('#id' + data.student.id).find("td:eq(3)").replaceWith(male);
                } else {
                    $('#id' + data.student.id).find("td:eq(3)").replaceWith(female);
                }
                $('#id' + data.student.id).find("td:eq(5)").text(data.faculty_name);
                $('body').removeAttr('data-bs-padding-right');
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