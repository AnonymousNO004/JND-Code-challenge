<!doctype html>
<html lang="en">
    <head>
        <title>{{$page_title}}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        @yield('css')
	</head>
	<body class="img js-fullheight">
        @yield('body')
        @yield('modals')

        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="//prakun.com/Components/assets/js/jquery/jquery.validate.min.js"></script>
        <script src="{{asset('js/popper.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/sweetalert2@11.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script>
            const url_gb = "{{url('/')}}";
        </script>
        @yield('js')
	</body>
</html>

