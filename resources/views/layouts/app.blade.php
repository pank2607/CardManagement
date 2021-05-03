<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex">      
        <style type="text/css">
             body{
                background: -webkit-linear-gradient(left, #3931af, #00c6ff);    
            }
            .main-content{margin-bottom: 10px;}
        </style>
        @yield('page-css')
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">        
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>       
    </head>
    <body style="margin: 20px">
        <!-- =========================Content Start===================== -->
                                    @yield('content')
        <!-- ===========================Content End===================== -->
        <footer class="footer">
            <span>Copyright &copy; {{date('Y')}} CardManagement</span>
        </footer>     
        <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>     
        @yield('Page-Js')
    </body>
</html>
