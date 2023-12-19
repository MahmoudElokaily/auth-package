<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--  start toastr  --}}
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
    {{--  end toastr  --}}
    <link href="{{asset('plugins/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("css/auth/style.css")}}">
    @stack("css")
    <title>Elokaily | @yield("title" , $title ?? "")</title>
</head>
<body>

@section("content")
@show


<script src="{{asset('plugins/jquery/jquery-3.7.1.min.js')}}"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right", // Set the position to bottom-right
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{$error}}");
    @endforeach
    @endif

    @if(session()->get("success"))

    toastr.success("{{session('success')}}");
    @endif
    @if(session('error'))
    toastr.error("{{session('error')}}");
    @endif
</script>
@stack("js")
</body>
</html>
