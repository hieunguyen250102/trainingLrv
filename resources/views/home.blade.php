@extends('layouts.admin.main')
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
                <!-- user profile header end-->
                <div class="col-xl-3 col-lg-12 col-md-5 xl-35">
                    <div class="default-according style-1 faq-accordion job-accordion">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="p-0">
                                            <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">About Me</button>
                                        </h5>
                                    </div>
                                    <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                                        <div class="card-body post-about">
                                            <ul>
                                                <li>
                                                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                                        </svg></div>
                                                    <div>
                                                        <h5>UX desginer at Pixelstrap</h5>
                                                        <p>banglore - 2021</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book">
                                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                                        </svg></div>
                                                    <div>
                                                        <h5>studied computer science</h5>
                                                        <p>at london univercity - 2015</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                        </svg></div>
                                                    <div>
                                                        <h5>relationship status</h5>
                                                        <p>single</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                            <circle cx="12" cy="10" r="3"></circle>
                                                        </svg></div>
                                                    <div>
                                                        <h5>lived in london</h5>
                                                        <p>last 5 year</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet">
                                                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                                                        </svg></div>
                                                    <div>
                                                        <h5>blood group</h5>
                                                        <p>O+ positive</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="social-network theme-form">
                                                <span class="f-w-600">Social Networks</span>
                                                <button class="btn social-btn btn-fb mb-2 text-center"><i class="fa fa-facebook m-r-5"></i>Facebook</button>
                                                <button class="btn social-btn btn-twitter mb-2 text-center"><i class="fa fa-twitter m-r-5"></i>Twitter</button>
                                                <button class="btn social-btn btn-google text-center"><i class="fa fa-dribbble m-r-5"></i>Dribbble</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="p-0">
                                            <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon8" aria-expanded="true" aria-controls="collapseicon8">Followers</button>
                                        </h5>
                                    </div>
                                    <div class="collapse show" id="collapseicon8" aria-labelledby="collapseicon8" data-parent="#accordion">
                                        <div class="card-body social-list filter-cards-view">
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/2.png">
                                                <div class="media-body"><span class="d-block">Bucky Barnes</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.png">
                                                <div class="media-body"><span class="d-block">Sarah Loren</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.jpg">
                                                <div class="media-body"><span class="d-block">Jason Borne</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/10.jpg">
                                                <div class="media-body"><span class="d-block">Comeren Diaz</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/11.png">
                                                <div class="media-body"><span class="d-block">Andew Jon</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="p-0">
                                            <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon11" aria-expanded="true" aria-controls="collapseicon11">Followings</button>
                                        </h5>
                                    </div>
                                    <div class="collapse show" id="collapseicon11" aria-labelledby="collapseicon11" data-parent="#accordion">
                                        <div class="card-body social-list filter-cards-view">
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.png">
                                                <div class="media-body"><span class="d-block">Sarah Loren</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/2.png">
                                                <div class="media-body"><span class="d-block">Bucky Barnes</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/10.jpg">
                                                <div class="media-body"><span class="d-block">Comeren Diaz</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.jpg">
                                                <div class="media-body"><span class="d-block">Jason Borne</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                            <div class="media">
                                                <img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/user/11.png">
                                                <div class="media-body"><span class="d-block">Andew Jon</span><a href="javascript:void(0)">Add Friend</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="p-0">
                                            <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon4" aria-expanded="true" aria-controls="collapseicon4">Latest Photos</button>
                                        </h5>
                                    </div>
                                    <div class="collapse show" id="collapseicon4" data-parent="#accordion" aria-labelledby="collapseicon4">
                                        <div class="card-body photos filter-cards-view">
                                            <ul>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-1.png"></div>
                                                </li>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-2.png"></div>
                                                </li>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-3.png"></div>
                                                </li>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-4.png"></div>
                                                </li>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-5.png"></div>
                                                </li>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-6.png"></div>
                                                </li>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-7.png"></div>
                                                </li>
                                                <li>
                                                    <div class="latest-post"><img class="img-fluid" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/social-app/post-8.png"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="p-0">
                                            <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon13" aria-expanded="true" aria-controls="collapseicon13">Friends</button>
                                        </h5>
                                    </div>
                                    <div class="collapse show" id="collapseicon13" data-parent="#accordion" aria-labelledby="collapseicon13">
                                        <div class="card-body avatar-showcase filter-cards-view">
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.jpg" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/5.jpg" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/1.jpg" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/2.png" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.png" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/6.jpg" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/10.jpg" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/14.png" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/1.jpg" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/4.jpg" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/11.png" alt="#"></div>
                                            <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/8.jpg" alt="#"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-12 col-md-7 xl-65">
                    <div class="row">
                        <!-- profile post start-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="profile-post">
                                    <div class="post-header">
                                        <div class="media">
                                            <img class="img-thumbnail rounded-circle me-3" src="https://laravel.pixelstrap.com/viho/assets/images/user/7.jpg" alt="Generic placeholder image">
                                            <div class="media-body align-self-center">
                                                <a href="#">
                                                    <h5 class="user-name">Emay Walter</h5>
                                                </a>
                                                <h6>22 Hours ago</h6>
                                            </div>
                                        </div>
                                        <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                                    </div>
                                    <div class="post-body">
                                        <div class="img-container">
                                            <div class="my-gallery" id="aniimated-thumbnials" itemscope="" data-pswp-uid="1">
                                                <figure itemprop="associatedMedia" itemscope="">
                                                    <a href="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post1.jpg" itemprop="contentUrl" data-size="1600x950">
                                                        <img class="img-fluid rounded" src="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post1.jpg" itemprop="thumbnail" alt="gallery">
                                                    </a>
                                                    <figcaption itemprop="caption description">Image caption 1</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="post-react">
                                            <ul>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.jpg" alt=""></li>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/5.jpg" alt=""></li>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/1.jpg" alt=""></li>
                                            </ul>
                                            <h6>+5 people react this post</h6>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <ul class="post-comment">
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                        </svg>&nbsp;&nbsp;Like<span class="counter">22</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                        </svg>&nbsp;&nbsp;Comment<span class="counter">31</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share">
                                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                                            <polyline points="16 6 12 2 8 6"></polyline>
                                                            <line x1="12" y1="2" x2="12" y2="15"></line>
                                                        </svg>&nbsp;&nbsp;share<span class="counter">8</span></a>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile post end-->
                        <!-- profile post start-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="profile-post">
                                    <div class="post-header">
                                        <div class="media">
                                            <img class="img-thumbnail rounded-circle me-3" src="https://laravel.pixelstrap.com/viho/assets/images/user/7.jpg" alt="Generic placeholder image">
                                            <div class="media-body align-self-center">
                                                <a href="#">
                                                    <h5 class="user-name">Emay Walter</h5>
                                                </a>
                                                <h6>5 Hours ago</h6>
                                            </div>
                                        </div>
                                        <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                                    </div>
                                    <div class="post-body">
                                        <div class="img-container">
                                            <div class="row mt-4 pictures my-gallery" id="aniimated-thumbnials-2" itemscope="" data-pswp-uid="2">
                                                <figure class="col-sm-6" itemprop="associatedMedia" itemscope="">
                                                    <a href="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post2.jpg" itemprop="contentUrl" data-size="1600x950">
                                                        <img class="img-fluid rounded" src="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post2.jpg" itemprop="thumbnail" alt="gallery">
                                                    </a>
                                                    <figcaption itemprop="caption description">Image caption 1</figcaption>
                                                </figure>
                                                <figure class="col-sm-6" itemprop="associatedMedia" itemscope="">
                                                    <a href="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post3.jpg" itemprop="contentUrl" data-size="1600x950">
                                                        <img class="img-fluid rounded" src="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post3.jpg" itemprop="thumbnail" alt="gallery">
                                                    </a>
                                                    <figcaption itemprop="caption description">Image caption 2</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="post-react">
                                            <ul>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.jpg" alt=""></li>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/5.jpg" alt=""></li>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/1.jpg" alt=""></li>
                                            </ul>
                                            <h6>+25 people react this post</h6>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <ul class="post-comment">
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                        </svg>&nbsp;&nbsp;Like<span class="counter">348</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                        </svg>&nbsp;&nbsp;Comment<span class="counter">56</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share">
                                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                                            <polyline points="16 6 12 2 8 6"></polyline>
                                                            <line x1="12" y1="2" x2="12" y2="15"></line>
                                                        </svg>&nbsp;&nbsp;share<span class="counter">19</span></a>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile post end   -->
                        <!-- profile post start-->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="profile-post">
                                    <div class="post-header">
                                        <div class="media">
                                            <img class="img-thumbnail rounded-circle me-3" src="https://laravel.pixelstrap.com/viho/assets/images/user/7.jpg" alt="Generic placeholder image">
                                            <div class="media-body align-self-center">
                                                <a href="#">
                                                    <h5 class="user-name">Emay Walter</h5>
                                                </a>
                                                <h6>2 Hours ago</h6>
                                            </div>
                                        </div>
                                        <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                                    </div>
                                    <div class="post-body">
                                        <div class="img-container">
                                            <div class="my-gallery" id="aniimated-thumbnials" itemscope="" data-pswp-uid="3">
                                                <figure itemprop="associatedMedia" itemscope="">
                                                    <a href="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post4.jpg" itemprop="contentUrl" data-size="1600x950">
                                                        <img class="img-fluid rounded" src="https://laravel.pixelstrap.com/viho/assets/images/user-profile/post4.jpg" itemprop="thumbnail" alt="gallery">
                                                    </a>
                                                    <figcaption itemprop="caption description">Image caption 1</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="post-react">
                                            <ul>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/3.jpg" alt=""></li>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/5.jpg" alt=""></li>
                                                <li><img class="rounded-circle" src="https://laravel.pixelstrap.com/viho/assets/images/user/1.jpg" alt=""></li>
                                            </ul>
                                            <h6>+20 people react this post</h6>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <ul class="post-comment">
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                        </svg>&nbsp;&nbsp;Like<span class="counter">407</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                        </svg>&nbsp;&nbsp;Comment<span class="counter">302</span></a>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share">
                                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                                            <polyline points="16 6 12 2 8 6"></polyline>
                                                            <line x1="12" y1="2" x2="12" y2="15"></line>
                                                        </svg>&nbsp;&nbsp;share<span class="counter">180</span></a>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile post end                           -->
                    </div>
                </div>
                <!-- user profile fifth-style end-->
                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="pswp__bg"></div>
                    <div class="pswp__scroll-wrap">
                        <div class="pswp__container">
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                            <div class="pswp__item"></div>
                        </div>
                        <div class="pswp__ui pswp__ui--hidden">
                            <div class="pswp__top-bar">
                                <div class="pswp__counter"></div>
                                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                <button class="pswp__button pswp__button--share" title="Share"></button>
                                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                <div class="pswp__preloader">
                                    <div class="pswp__preloader__icn">
                                        <div class="pswp__preloader__cut">
                                            <div class="pswp__preloader__donut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                <div class="pswp__share-tooltip"></div>
                            </div>
                            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                            <div class="pswp__caption">
                                <div class="pswp__caption__center"></div>
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
                {{ Form::model($user, ['method' => 'POST', 'enctype'  => 'multipart/form-data', 'id' => 'form-update']) }}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input name="avatar" id="avatar" onchange="loadFile(event)" class="form-control <?php echo ($errors->first('image') ? 'is-invalid' : ' ') ?>" type="file">
                        <div class="invalid-feedback">{{$errors->first('image')}}</div>
                        <div class="form-row">
                            <img width="100px" src="" alt="" id="output">
                        </div>
                    </div>
                </div>
                {!! Form::submit('Save', ['class' => 'btn btn-secondary','id' => 'saveUpdateForm'])!!}
                {!! Form::button('Cancel', ['class' => 'btn btn-primary','data-bs-dismiss' => 'modal'])!!}
                {!! Form::close() !!}
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

    // $('.btnModal').on('click', function() {
    //     var id = $(this).attr('data-id');
    //     $.ajax({
    //         method: "GET",
    //         dataType: "json",
    //         url: 'students/' + id + '/edit',
    //         success: function(data) {
    //             var output = document.getElementById('output');
    //             output.src = 'public/img/profiles'.data.student.avatar;
    //         }
    //     })
    // });

    $('#saveUpdateForm').on('click', function(event) {
        event.preventDefault();
        var id = $('.btnModal').attr('data-id');
        var href = 'update/avatar/' + id;
        $('form').attr('action', href);
        var formData = new FormData($('#form-update')[0]).getAll('avatar');
        $.ajax({
            url: "/update/avatar/" + id,
            type: "POST",
            data: {
                id: id,
                processData: false,
                contentType: false,
                data: formData,
                _method: 'PUT'
            },
            dataType: 'json',
            success: function(data) {
                Swal.fire(
                    'Successful!',
                    'Student update successfully!',
                    'success'
                )
                $('#id' + data.student.id).find("td:eq(5)").text(data.faculty_name);
                $('body').removeAttr('data-bs-padding-right');
            }
        })
    });
</script>
@endsection