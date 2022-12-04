<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">
<link rel="shortcut icon" href="{{ asset('assets/imgs/background/logo.png') }}">
<title style="color:green;">SAO</title>
<!--Morris Chart CSS -->
<link href="{{ asset('assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
<!-- modal -->
<link href="{{ asset('assets/plugins/custombox/dist/custombox.min.css') }}" rel="stylesheet">
<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="{{ asset('stylesheet" href="assets/plugins/morris/morris.css') }}">
<link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/jquery.Bootstrap-PersianDateTimePicker.css') }}" rel="stylesheet"/>
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/css/select2.min.css" rel="stylesheet" />

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-74137680-1', 'auto');
    ga('send', 'pageview');
</script>
</head>
<body style="font-family:IranSansweb;">
        <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main" style="background-color:#0078d4">
            <div class="container">
                <!-- LOGO -->
                <div class="topbar-left">
                 <a href="{{ route('sector') }}" class="logo"><span style="margin-right:150px"> {{ Auth::user()->departments['department'] }}</span></a>
                </div>
                <!-- End Logo container-->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-custom" style="background-color:#0078d4">
            <div class="container">
                <div id="navigation" style="margin-right: 10px">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="active">
                            <a href="{{ route('sector') }}" class="active" style="color:white"><i class="fa fa-home" style="margin-top:-15px;color:white"></i> <span> </span> </a>
                        </li>
                        <li class="dropdown" style="margin-top:10px">
                            <button class="btn btn-info dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                مکاتیب
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="about-us">
                                <li><a href="{{ route('sector.maktob_show') }}">وارده و صادره</a></li>
                                <li><a href="{{ route('sector.maktob_saved_show') }}">حفظیه</a></li>
                                <li><a href="{{ route('sector.maktob_response_show') }}">جواب</a></li>
                                <li><a href="{{route('sector.maktob_salahiat_show')}}">صلاحیت نامه</a></li>
                                <li><a href="{{route('sector.maktob_plan_show')}}">پلان</a></li>
                            </ul>
                        </li>
                        <li class="dropdown" style="margin-right:10px;margin-top:10px">
                            <button class="btn btn-info dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                گزارشات
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="about-us">
                                <li><a href="{{ route('sector.report_auditor_show') }}">گزارش مفتیش</a></li>
                                <li><a href="{{ route('sector.report_analyse_show') }}">گزارش ریاست تحلیل</a></li>
                                <li><a href="{{ route('sector.report_source_show') }}">گزارش مراجع</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="{{route('sector.suggestion_show')}}"><button class="btn btn-info"style="margin-top:-15px;margin-left:-40px;margin-right:-15px">پیشنهادات</button></a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{route('sector.claim_show')}}"><button class="btn btn-info"style="margin-top:-15px;margin-left:-40px">اعتراضیه</button></a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{route('sector.justice_show')}}"><button class="btn btn-info"style="margin-top:-15px;margin-left:-40px">تعقیب عدلی</button></a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{ route('sector.control_show') }}"><button class="btn btn-info"style="margin-top:-15px;margin-left:-40px">نظارت</button></a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{ route('sector.auditor_show') }}"><button class="btn btn-info"style="margin-top:-15px;margin-left:-20px">مفتیشن</button></a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{ route('reports') }}"><i class="zmdi zmdi-download" style="margin-top:-15px;margin-left:-40px;color:white"></i></a>
                        </li>
                        @if(Auth::user()->role == 'admin' && Auth::user()->name == 'administrator')
                        <li class="has-submenu">
                            <a href="{{ route('accounts.index') }}"><i class="zmdi zmdi-account-circle" style="margin-top:-15px;margin-left:-40px;color:white"></i></a>
                        </li>
                        @endif
                        <li class="has-submenu">
                            <a href="{{ route('sector.profile') }}"><i class="zmdi zmdi-settings" style="margin-top:-15px;margin-left:-40px;color:white"></i></a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{ route('sector.about') }}"><i class="zmdi zmdi-phone-msg" style="margin-top:-15px;margin-left:-40px;color:white"></i> </a>
                        </li>

                        <li class="has-submenu">
                    
                                <!-- Authentication -->
                                <a  href="{{ route('logout') }}"
                                style="margin-top:-5px;color:red"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out" aria-hidden="true" style="color:red"></i>
                                    {{ __('خروج') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            
                        </li>
                    </ul>
                    <!-- End navigation menu  -->
                </div>
            </div>
        </div>
    </header>
    <!-- End Navigation Bar-->
    <div class="wrapper">
    <div class="container">

    </script>
