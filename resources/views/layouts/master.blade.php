<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link href="{{asset('css/libs.css')}}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body id="admin-page">

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('posts.index')}}">Home</a>
        </div>
        <!-- /.navbar-header -->



        <ul class="nav navbar-top-links navbar-right">

        </ul>


        <ul id="navbar_right" class="nav navbar-nav navbar-right">
        @if(auth()->guest())
        @if(!Request::is('auth/login'))
        <li><a href="{{ url('/login') }}">Login</a></li>
        @endif
        @if(!Request::is('auth/register'))
        <li><a href="{{ url('/register') }}">Register</a></li>
        @endif
        @else
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome {{ auth()->user()->display_name ? auth()->user()->display_name : auth()->user()->nickname }}</a>

        <li><a href="{{ url('/logout') }}">Logout</a></li>

        <li><a href="{{route('users.edit', auth()->user()->slug)}}">Profile</a></li>

        </li>
        @endif
        </ul>


        @if(Auth::check())

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">


                    <li> <a href="{{route('users.index')}}">All Users</a> </li>

                    <li>
                        <a href="{{route('posts.create')}}"><i class="fa fa-wrench fa-fw"></i> Create post</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('my_posts')}}">My Posts</a>
                            </li>

                            <li>
                                <a href="{{route('follows_posts')}}">Follows Posts</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                </ul>


            </div>
            <!-- /.sidebar-collapse -->
        </div>

        @endif
        <!-- /.navbar-static-side -->
    </nav>


</div>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>

                @yield('content')
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{asset('js/libs.js')}}"></script>

@yield('footer')

</body>

</html>
