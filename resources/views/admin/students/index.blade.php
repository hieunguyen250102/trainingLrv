@extends('layouts.admin.main')
@section('title-page', __('lang.students.list.title'))
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>@lang('lang.students.list.title')</h5>
                    <form class="row theme-form mt-3" action="{{route('students.index')}}" method="GET">
                        <div class="col-xxl-4 mb-3 d-flex">
                            <label class="col-form-label pe-2" for="inputInlineUsername">{{__('lang.students.list.from')}}</label>
                            <input class="form-control" id="inputInlineUsername" type="number" name="age_from" placeholder="{{__('lang.students.list.from')}}" autocomplete="off">
                        </div>
                        <div class="col-xxl-4 mb-3 d-flex">
                            <label class="col-form-label pe-2" for="inputInlinePassword">{{__('lang.students.list.to')}}</label>
                            <input class="form-control" id="inputInlinePassword" type="number" name="age_to" placeholder="{{__('lang.students.list.to')}}" autocomplete="off">
                        </div>
                        <div class="col-xxl-4 mb-3 d-flex">
                            <button class="btn btn-primary">{{__('lang.students.list.btn-search')}}</button>
                        </div>
                    </form>
                    <button data-bs-target="#create-bookmark" data-bs-toggle="modal" class="btn btn-primary mt-3 mb-3 btn-create">{{__('lang.students.list.btn-create')}}</button>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-primary w-50 ml-30">
                    <p class="font-light">{{ session()->get('success') }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-border-vertical" style="text-align: center;" id="student-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('lang.students.list.table.col.name')</th>
                                <th scope="col">@lang('lang.students.list.table.col.email')</th>
                                <th scope="col">@lang('lang.students.list.table.col.avatar')</th>
                                <th scope="col">@lang('lang.students.list.table.col.mark')</th>
                                <th scope="col">@lang('lang.students.list.table.col.status')</th>
                                <th scope="col">@lang('lang.students.list.table.col.option')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr id="id{{$student->id}}">
                                    <th scope="row">{{$student->id}}</th>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->email}}</td>
                                    <td><img width="100px" src="{{asset('img/profiles/' . $student->avatar)}}"></td>
                                    @if($student->subjects->count() !== $subject->count())
                                        <td>Studying</td>
                                    @else
                                        @for($i = 0; $i < $subject->count(); $i++)
                                            @if($student->subjects[$i]->pivot->mark === null)
                                                <td>Studying</td>
                                                @break
                                            @elseif($i == $subject->count() - 1)
                                                <td>{{round($student->subjects->avg('pivot.mark'),2)}}</td>
                                            @endif
                                        @endfor
                                    @endif
                                    @if($student->subjects->count() !== $subject->count())
                                        <td><a href="/alert-subject/{{$student->id}}" class="btn btn-danger btn-xs"><i class="fa-solid fa-bell"></i></a></td>
                                    @else
                                        <td><button class="btn btn-primary btn-xs"><i class="fa-solid fa-check"></i></button></td>
                                    @endif
                                    <td>
                                        <button class="btn btn-warning btn-xs btnModal" data-id="{{$student->id}}" data-bs-target="#edit-bookmark" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger btn-xs btnDelete" data-id="{{$student->id}}" id="deleteStudent"><i class="fa-solid fa-trash"></i></button>
                                        <button class="btn btn-secondary btn-xs btn-modal-subject" data-id="{{$student->id}}" data-bs-target="#subject-bookmark" data-bs-toggle="modal"><i class="fa-solid fa-book"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="/alert-subject" method="GET" id="form-alert"> </form>
        <a href="/alert-subject" id="alert-subject-btn" onclick="return confirm('Do you want send to student?')" class="btn btn-primary float-end">{{__('lang.students.list.btn-send')}} <i class="fas fa-paper-plane"></i></a>
    </div>
</div>

<div class="modal fade modal-bookmark" id="create-bookmark" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('lang.students.form.create.title')</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::model($student, ['method' => 'POST', 'id' => 'create-form']) }}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.name'))!!}
                        {!!Form::text('name', '',['class' => 'form-control' ,'id' => 'name_student','placeholder' => __('lang.students.form.placeholder.input.name')])!!}
                        <div class="invalid-feedback validate-name"></div>
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.email'))!!}
                        {!!Form::email('email', '',['class' => 'form-control' ,'id' => 'email_student','placeholder' => __('lang.students.form.placeholder.input.email')])!!}
                        <div class="invalid-feedback validate-email"></div>
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.phone'))!!}
                        {!!Form::text('phone', '',['class' => 'form-control' ,'id' => 'phone_student','placeholder' => __('lang.students.form.placeholder.input.phone')])!!}
                        <div class="invalid-feedback validate-phone"></div>
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.birthday'))!!}
                        {!!Form::date('birthday', '',['class' => 'form-control' ,'id' => 'birthday_student'])!!}
                        <div class="invalid-feedback validate-birthday"></div>
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.address'))!!}
                        {!!Form::text('address', '',['class' => 'form-control' ,'id' => 'address_student','placeholder' => __('lang.students.form.placeholder.input.address')])!!}
                        <div class="invalid-feedback validate-address"></div>
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('', __('lang.students.form.title.input.gender'), ['class' => 'col-form-label pt-0']) }}
                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '0', true, ['class' => 'form-check-input', 'id' => 'radioinline11'])}}
                                {{ Form::label('radioinline11', __('lang.students.form.input.male'), ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '1', false, ['class' => 'form-check-input', 'id' => 'radioinline22'])}}
                                {{ Form::label('radioinline22', __('lang.students.form.input.female'), ['class' => 'mb-0']) }}
                            </div>
                            <div class="invalid-feedback validate-gender"></div>
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
                <h5 class="modal-title">@lang('lang.students.form.update.title')</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::model($student, ['method' => 'POST']) }}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.name'))!!}
                        @if ($errors->first('name'))
                        {!!Form::text('name', '',['class' => 'form-control is-invalid' ,'id' => 'name_student_edit','placeholder' => __('lang.students.form.title.input.name')])!!}
                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                        @else{!! Form::text('name', '', ['class' => 'form-control','id' => 'name_student_edit','placeholder' => __('lang.students.form.title.input.name')]) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.phone'))!!}
                        @if ($errors->first('phone'))
                        {!!Form::text('phone', '',['class' => 'form-control is-invalid' ,'id' => 'phone_student_edit','placeholder' => __('lang.students.form.title.input.phone')])!!}
                        <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                        @else{!! Form::text('phone', '', ['class' => 'form-control','id' => 'phone_student_edit','placeholder' => __('lang.students.form.title.input.phone')]) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.birthday'))!!}
                        @if ($errors->first('birthday'))
                        {!!Form::date('birthday', '',['class' => 'form-control is-invalid' ,'id' => 'birthday_student_edit'])!!}
                        <div class="invalid-feedback">{{$errors->first('birthday')}}</div>
                        @else{!! Form::date('birthday', '', ['class' => 'form-control','id' => 'birthday_student_edit']) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        {!!Form::label('', __('lang.students.form.title.input.address'))!!}
                        @if ($errors->first('address'))
                        {!!Form::text('address', '',['class' => 'form-control is-invalid' ,'id' => 'address_student_edit','placeholder' => __('lang.students.form.placeholder.input.address')])!!}
                        <div class="invalid-feedback">{{$errors->first('address')}}</div>
                        @else{!! Form::text('address', '', ['class' => 'form-control','id' => 'address_student_edit','placeholder' => __('lang.students.form.placeholder.input.address')]) !!}
                        @endif
                    </div>
                    <!-- <div class="form-group col-md-12">
                        {{ Form::label('faculty_id', 'Faculty', ['class' => 'col-form-label col-sm-3 pt-0']) }}
                        {!!Form::select('faculty_id', $faculties,'', ['id' => 'faculty_id_edit', 'class' => 'form-select digits'])!!}
                    </div> -->
                    <div class="form-group col-md-12">
                        {{ Form::label('', __('lang.students.form.title.input.gender'), ['class' => 'col-form-label pt-0']) }}
                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                            @if ($errors->first('gender'))
                            <div class="radio radio-primary">
                                {{Form::radio(__('lang.students.form.input.male'), '0', true, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline1_edit'])}}
                                {{ Form::label('radioinline1_edit', __('lang.students.form.input.male'), ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio(__('lang.students.form.input.female'), '1', false, ['class' => 'form-check-input is-invalid', 'id' => 'radioinline2_edit'])}}
                                {{ Form::label('radioinline2_edit', __('lang.students.form.input.female'), ['class' => 'mb-0']) }}
                            </div>
                            <div class="invalid-feedback">{{$errors->first('gender')}}</div>
                            @else
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '0', true, ['class' => 'form-check-input', 'id' => 'radioinline1_edit'])}}
                                {{ Form::label('radioinline1_edit', __('lang.students.form.input.male'), ['class' => 'mb-0']) }}
                            </div>
                            <div class="radio radio-primary">
                                {{Form::radio('gender', '1', false, ['class' => 'form-check-input', 'id' => 'radioinline2_edit'])}}
                                {{ Form::label('radioinline2_edit', __('lang.students.form.input.female'), ['class' => 'mb-0']) }}
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
                <h5 class="modal-title">Edit Student</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <form id="form-update-mark" method="post">
                        <table class="table table-border-vertical" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mark</th>
                                </tr>
                            </thead>
                            @csrf
                            @method('PUT')
                            <tbody id="table-subject">

                            </tbody>
                        </table>
                        <input type="hidden" name="student_id">
                        <button type="submit" class="btn btn-secondary" id="btn-update-mark">Save</button>
                        <button class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
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
                console.log(data);
                Swal.fire(
                    'Successful!',
                    'Create student successfully!',
                    'success'
                )

                $('#create-bookmark').removeAttr('style');
                $('#edit-bookmark').css('padding-right', ' ');
                $('.modal-backdrop').removeClass('modal-backdrop fade show');
                $('body').removeAttr("style");
                $('body').removeClass('modal-open');
                $('#student-table tbody').prepend('<tr id="' + data.student.id + '"><th scope="row">' + data.student.id + '</th><td>' + data.student.name + '</td><td>' + data.student.email + '</td><td><img width="100px" src="http://127.0.0.1:8000/public/img/profiles/" ' + data.student.avatar + '"></td><td>Have not registered enough subjects</td><td><a href="/alert-subject/' + data.student.id + '" class="btn btn-danger btn-xs"><i class="fa-solid fa-bell"></i></a></td><td><button class="btn btn-warning btn-xs btnModal" data-id="' + data.student.id + '" data-bs-target="#edit-bookmark" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></button><button class="btn btn-danger btn-xs btnDelete" data-id="' + data.student.id + '" id="deleteStudent"><i class="fa-solid fa-trash"></i></button></td></tr>');
                $('#create-form')[0].reset();
            },
            error: function(errors) {
                console.log(errors.responseJSON);
                if (errors.responseJSON.errors.name) {
                    $('.validate-name').text(errors.responseJSON.errors.name);
                    $('#name_student').addClass('is-invalid');
                } else {
                    $('.validate-name').text('');
                    $('#name_student').removeClass('is-invalid');
                }
                if (errors.responseJSON.errors.email) {
                    $('.validate-email').text(errors.responseJSON.errors.email);
                    $('#email_student').addClass('is-invalid');
                } else {
                    $('.validate-email').text('');
                    $('#email_student').removeClass('is-invalid');
                }
                if (errors.responseJSON.errors.phone) {
                    $('.validate-phone').text(errors.responseJSON.errors.phone);
                    $('#phone_student').addClass('is-invalid');
                } else {
                    $('.validate-phone').text('');
                    $('#phone_student').removeClass('is-invalid');
                }
                if (errors.responseJSON.errors.birthday) {
                    $('.validate-birthday').text(errors.responseJSON.errors.birthday);
                    $('#birthday_student').addClass('is-invalid');
                } else {
                    $('.validate-birthday').text('');
                    $('#birthday_student').removeClass('is-invalid');
                }
                if (errors.responseJSON.errors.address) {
                    $('.validate-address').text(errors.responseJSON.errors.address);
                    $('#address_student').addClass('is-invalid');
                } else {
                    $('.validate-address').text('');
                    $('#address_student').removeClass('is-invalid');
                }
                if (errors.responseJSON.errors.gender) {
                    $('.validate-gender').text(errors.responseJSON.errors.gender);
                    $('#gender_student').addClass('is-invalid');
                } else {
                    $('.validate-gender').text('');
                    $('#gender_student').removeClass('is-invalid');
                }
            }
        })
    });

    //Delete ajax
    $(".btnDelete").click(function() {
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

    $('.btn-modal-subject').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var url = '/students/' + id + '/update/mark/';
        $('#form-update-mark').attr('action', url);
        $('input[name=student_id]').val(id);
        $.ajax({
            method: "GET",
            dataType: "json",
            url: 'students/subjects/' + id,
            success: function(data) {
                var tr = '';
                data.subjects.forEach(element => {
                    tr += `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.name}</td>
                            <td><input class="form-control" name="mark[]" type="number" value="${element.pivot.mark}"></td>
                            <input type="hidden" name="subject_id[]" value="${element.id}">
                        </tr>
                    `;
                });
                $('#table-subject').html(tr);
            }
        })
    });
</script>
@endsection
@endsection