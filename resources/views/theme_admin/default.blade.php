<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="By Hakys">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <!-- Bootstrap v3.3.7 Core CSS -->
    <link href="{!! asset('theme_admin/vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{!! asset('theme_admin/vendor/metisMenu/metisMenu.min.css') !!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!! asset('theme_admin/dist/css/sb-admin-2.css') !!}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{!! asset('theme_admin/vendor/morrisjs/morris.css') !!}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Custom Fonts -->
    <link href="{!! asset('theme_admin/vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/yellow.css">
    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    @yield('style') 
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top mb-0" role="navigation" style="margin-bottom: 0">
            @include('theme_admin.header')
            @include('theme_admin.sidebar')
        </nav>
        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{!! asset('theme_admin/vendor/jquery/2.2.4/jquery.min.js') !!}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{!! asset('theme_admin/vendor/popper/popper.min.js') !!}"></script>
    <script src="{!! asset('theme_admin/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{!! asset('theme_admin/vendor/metisMenu/metisMenu.min.js') !!}"></script>
    <!-- Morris Charts JavaScript -->
    <script src="{!! asset('theme_admin/vendor/raphael/raphael.min.js') !!}"></script>
    <script src="{!! asset('theme_admin/vendor/morrisjs/morris.min.js') !!}"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="{!! asset('theme_admin/dist/js/sb-admin-2.js') !!}"></script>

    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

   
   
    @yield('script')

</body>
</html>