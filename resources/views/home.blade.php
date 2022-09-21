@extends('layouts.admin.main')
@section('title-page', 'Homepage')
@section('content')
@if(Auth::check())
@if(Auth::user()->roles[0]['name'] === 'student')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>User Profile</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item">Students</li>
                        <li class="breadcrumb-item active">Student Profile</li>
                    </ol>
                </div>
                <div class="col-lg-6">
                    <!-- Bookmark Start-->
                    <div class="bookmark">
                        <ul>
                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                        <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                    </svg></a></li>
                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg></a></li>
                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-command">
                                        <path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"></path>
                                    </svg></a></li>
                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg></a></li>
                            <li>
                                <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star bookmark-search">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg></a>
                                <form class="form-inline search-form">
                                    <div class="form-group form-control-search">
                                        <input type="text" placeholder="Search..">
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- Bookmark Ends-->
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile header start-->
                <div class="col-sm-12">
                    <div class="card profile-header bg-size" style="background-image: url('https://thumbs.dreamstime.com/b/female-hands-typing-laptop-student-workspace-blue-pastel-background-supplies-banner-copy-space-182572747.jpg'); background-size: cover; background-position: center center; display: block;">
                        <img class="img-fluid bg-img-cover" src="https://thumbs.dreamstime.com/b/female-hands-typing-laptop-student-workspace-blue-pastel-background-supplies-banner-copy-space-182572747.jpg" alt="" style="display: none;">
                        <div class="profile-img-wrrap bg-size" style="background-image: url('https://thumbs.dreamstime.com/b/female-hands-typing-laptop-student-workspace-blue-pastel-background-supplies-banner-copy-space-182572747.jpg'); background-size: cover; background-position: center center; display: block;"><img class="img-fluid bg-img-cover" src="https://thumbs.dreamstime.com/b/female-hands-typing-laptop-student-workspace-blue-pastel-background-supplies-banner-copy-space-182572747.jpg" alt="" style="display: none;"></div>
                        <div class="userpro-box">
                            <div class="img-wrraper">
                                <div class="avatar"><img class="img-fluid" alt="" src="{{asset('img/profiles/'. Auth::user()->avatar)}}"></div>
                                <a class="icon-wrapper btnModal" data-id="{{Auth::id()}}" data-bs-target="#edit-bookmark" data-bs-toggle="modal"><i class="icofont-pencil-alt-1"></i></a>
                            </div>
                            <div class="user-designation">
                                <div class="title">
                                    <a target="_blank" href="">
                                        <h4>{{Auth::user()->name}}</h4>
                                    </a>
                                </div>
                                <div class="social-media">
                                    <ul class="user-list-social">
                                        <li>
                                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-google-plus"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-rss"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="follow">
                                    <ul class="follow-list">
                                        <li>
                                            <div class="follow-num counter">325</div>
                                            <span>Follower</span>
                                        </li>
                                        <li>
                                            <div class="follow-num counter">450</div>
                                            <span>Following</span>
                                        </li>
                                        <li>
                                            <div class="follow-num counter">500</div>
                                            <span>Likes</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <form method="post" action="/update/avatar/{{Auth::id()}}" enctype="multipart/form-data" id="form-update">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input name="avatar" id="avatar" onchange="loadFile(event)" class="form-control <?php echo ($errors->first('image') ? 'is-invalid' : ' ') ?>" type="file">
                            <div class="invalid-feedback">{{$errors->first('image')}}</div>
                            <div class="form-row">
                                <img width="100px" src="" alt="" id="output">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary" id="saveUpdateForm">Save</button>
                    <button class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@else
<div class="page-body">
    <div class="container-fluid">
        <div class="col-lg-9 text-center mb-3">
            <h1 class="mt-5">Manage Students System</h1>
            <p class="lead">Nguyen Trung Hieu</p>
            <img src="{{asset('img/bgtest.png')}}" width="130px;" />
        </div>
    </div>
</div>
@endif
@endsection
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

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

</script>
@endsection