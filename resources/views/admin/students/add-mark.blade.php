@extends('layouts.admin.main')
@section('title-page', 'Add mark student')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>List marks students</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                </div>
                @if (session()->has('success'))
                <div class="alert alert-primary w-50 ml-30">
                    <p class="font-light">{{ session()->get('success') }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dynamicTable">
                        <thead>
                            <th scope="col">Id</th>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mark</th>
                        </thead>
                        @foreach ($subject->students as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->code}}</td>
                            <td>{{$student->name}}</td>
                            @if(!$student->pivot->mark)
                            <td>Chưa có điểm</td>
                            @else
                            <td>{{$student->pivot->mark}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="float-end">
            <button class="btn btn-primary" data-bs-target="#edit-bookmark" data-bs-toggle="modal"><i class="fa-solid fa-file-upload"></i></button>
            <a href="/export/{{$subject->id}}" class="btn btn-secondary"><i class="fa-solid fa-file-export"></i></a>
        </div>
    </div>
</div>
<div class="modal fade modal-bookmark" id="edit-bookmark" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import mark</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/import/{{$subject->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary">Import</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
            {!!Form::hidden('student_id', '',['id' => 'student_id'])!!}
            {!!Form::hidden('user_id', '',['id' => 'user_id'])!!}
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    var i = 0;
    $("#add").click(function() {
        ++i;
        $("#dynamicTable").append('<tr><td><select name="subject_id" class="form-select digits" id="select ' + i + '">' + selectOption + '</select></td><td><input type="text" name="mark" placeholder="Enter mark" class="form-control"/></td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        $('select').on("change", function() {
            var value = $('#select ' + i).val();
            console.log(value);
            if (value !== '') {
                $('#select ' + (i + 1) + ' option[value="' + value + '"').hide();
                $('#select ' + (i + 1) + ' option[value!="' + value + '"').show();
            }
        });
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>
@endsection