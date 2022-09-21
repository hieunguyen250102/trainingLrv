@extends('layouts.admin.main')
@section('title-page', 'List subjects')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>List subjects</h5>
                    @can('create')
                    <a href="{{route('subjects.create')}}"><button class="btn btn-primary mt-3">Create</button></a>
                    @endcan
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
                                <th scope="col">Name subject</th>
                                @if(Auth::user()->roles[0]['name'] === 'student')
                                <th scope="col">Mark subject</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input id="checkAll" type="checkbox"></th>
                                @else
                                <th scope="col">Options</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                            <tr id="id{{$subject->id}}">
                                <th scope="row">{{$subject->id}}</th>
                                <td>{{$subject->name}}</td>
                                @if(Auth::user()->roles[0]['name'] === 'student')
                                @if($results->isEmpty())
                                <td>
                                    Null
                                </td>
                                <td><a>Register</a></td>
                                <td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">
                                    <input type="checkbox" value="{{$subject->id}}">
                                </td>
                                @else
                                @for($i = 0; $i < $results->count(); $i++)
                                    @if($subject->id == $results[$i]->id)
                                    @if($results[$i]->pivot->mark == null)
                                    <td>
                                        Null
                                    </td>
                                    <td>
                                        <span class="font-primary first_name_0">Registered</span>
                                    </td>
                                    <td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">
                                        <input type="checkbox" value="{{$subject->id}}" checked disabled>
                                    </td>
                                    @else
                                    <td>
                                        {{$results[$i]->pivot->mark}}
                                    </td>
                                    <td>
                                        <span class="font-primary first_name_0">Registered</span>
                                    </td>
                                    <td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">
                                        <input type="checkbox" value="{{$subject->id}}" checked disabled>
                                    </td>
                                    @endif
                                    @break
                                    @elseif($i == $results->count() - 1)
                                    @if($subject->id != $results[$i]->id)
                                    <td>
                                        Null
                                    </td>
                                    <td>
                                        <a>Register</a>
                                    </td>
                                    <td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">
                                        <input type="checkbox" value="{{$subject->id}}">
                                    </td>
                                    @endif
                                    @endif
                                    @endfor
                                    @endif
                                    @endif
                                    @can('create')
                                    <td>
                                        <a href="{{route('export-view',$subject->id)}}" class="btn btn-primary"><i class="fa-solid fa-file-export"></i></a>
                                        <a href="{{route('subjects.edit',['subject' => $subject->id])}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a data-id="{{$subject->id}}" id="deleteSubject" class="btn btn-danger btnDelete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                    @endcan
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
            @if(Auth::user()->roles[0]['name'] === 'student')
            <a class="register-subject"><button class="btn btn-primary float-end">Register</button></a>
            @endif
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
                    {!! Form::open(array('url' => '', 'class' => 'form-bookmark needs-validation')) !!}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {!!Form::label('', 'Name subject')!!}
                            @if ($errors->first('name'))
                            {!!Form::text('name', '',['class' => 'form-control is-invalid' ,'id' => 'namesubject','placeholder' => 'Enter name subject'])!!}
                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @else{!! Form::text('name', '', ['class' => 'form-control','id' => 'namesubject','placeholder' => 'Enter name subject']) !!}
                            @endif
                            {!!Form::hidden('subject_id', '',['id' => 'subject_id'])!!}
                        </div>
                    </div>
                    {!! Form::button('Save', ['class' => 'btn btn-secondary','id' => 'saveUpdateForm'])!!}
                    {!! Form::button('Cancel', ['class' => 'btn btn-primary','data-bs-dismiss' => 'modal'])!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function update(id) {
        // var id = $(this).attr('data-id');
        $.get('subjects/' + id + '/edit', function(data) {
            $('#namesubject').val(data.subject.name);
            $('#subject_id').val(data.subject.id);
        })
    };

    var id = $('#subject_id').val()
    $('#saveUpdateForm').on('click', function(id) {
        saveUpdate(id);
    });

    function saveUpdate() {
        var name = $('#namesubject').val();
        var id = $('#subject_id').val();
        var url = '/admin/subjects/'
        $.ajax({
            url: "/admin/subjects/" + id,
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


    $("#deleteSubject").click(function() {
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
                fail: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Something went wrong!',
                    })
                }
            });
        }
    });

    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('.register-subject').on('click', function() {
        var elements = document.querySelectorAll("tbody input:checked");
        var ids = Array.prototype.map.call(elements, function(el, i) {
            return el.value;
        });
        var id = $(this).data("id");
        $.ajax({
            url: "/register-subject/",
            type: "GET",
            data: {
                data: ids,
            },
            dataType: 'json',
            success: function(data) {
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                )
                data.listSubjects.forEach(element => {
                    $('#id' + element.id).find("td:eq(2)").replaceWith('<td><span class="font-primary first_name_0">Registered</span></td>');
                    $("checkAll").attr("disabled", true);
                });
            },
            error: function() {
                Swal.fire(
                    'cc!',
                    'You clicked the button!',
                    'error'
                )
            }
        })
    });
</script>
@endsection
@endsection