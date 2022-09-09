<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40" />
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="pixelstrap" />
    <link rel="icon" href="{{asset('/images/favicon.ico')}}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('/images/favicon.ico')}}" type="image/x-icon" />
    <title>NTH - Mail</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}" />
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/icofont.css')}}" />
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}" />
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flag-icon.css')}}" />
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icofont/icofont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/feather-icon.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}" />
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen" />
    <!-- Responsive css-->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body style="margin: 30px auto;">
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>
                    <table style="background-color: #f6f7fb; width: 100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="width: 650px; margin: 0 auto; margin-bottom: 30px;">
                                        <tbody>
                                            <tr>
                                                <td><img src="https://laravel.pixelstrap.com/viho/assets/images/logo/logo.png" alt=""></td>
                                                <td style="text-align: right; color: #999;"><span>Some Description</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 30px;">
                                                    <p>Hi {{$user->name}},</p>
                                                    <p>We send you account to login.</p>
                                                    <p>Email: {{$user->email}}</p>
                                                    <p>Password: 12345678</p>
                                                    <p style="margin-bottom: 0;">Good luck! Hope it works.</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; margin-top: 30px;">
                                        <tbody>
                                            <tr style="text-align: center;">
                                                <td>
                                                    <p style="color: #999; margin-bottom: 0;">333 Woodland Rd. Baldwinsville, NY 13027</p>
                                                    <p style="color: #999; margin-bottom: 0;">Don't Like These Emails?<a href="javascript:void(0)" style="color: #24695c;">Unsubscribe</a></p>
                                                    <p style="color: #999; margin-bottom: 0;">Powered By viho Admin</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
    <script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
    <script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
    <!-- <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script> -->
    <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
    <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/vector-map/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/js/notify/index.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>