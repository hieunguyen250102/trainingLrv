@extends('layout.admin.main')
@section('title-page', 'Create new category')
@section('content')
<!-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css"> -->

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Create new faculty</h5>
                        <!-- <span>Using the <a href="#">card</a> component, you can extend the default collapse behavior to create an accordion.</span> -->
                    </div>
                    <div class="card-body">
                        <form action="{{route('faculties.store')}}" method="POST" class="theme-form" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Name faculty</label>
                                <input name="name" class="form-control <?php echo ($errors->first('name') ? 'is-invalid' : ' ') ?>" id="exampleInputEmail1" type="text" placeholder="Enter name faculty" value="{{old('name')}}">
                                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    // Tag
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>
@endsection