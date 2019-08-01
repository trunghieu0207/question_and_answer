<!DOCTYPE html>
<html>
<head>
    @include('layout.css')
    @yield('css')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style type="text/css" media="screen">
    </style>
</head>
<body class="main-background">

    @include('layout.header')

    @yield('content')

    @include('layout.js')
    @yield('js')

    <script>
        $('#search').keyup(function () {
            var keyword = $(this).val();
            if (keyword != '') {
                $.ajax({
                    url: "{{ route('search') }}",
                    method: "GET",
                    data: {
                        keyword
                    },
                    success: function (data) {
						if(data!=""){
							$('#result_list').html(data);
							$('#result_list').show();
						}
						else $('#result_list').hide();
                    }
                })
            }
			else $('#result_list').hide();
        });
        function submit_search(){
            if($('#search').val()!='') $('#searchform').submit();
        }
        @if(Auth::check())
        function read_notification(){
            $.ajax({
                    url: "{{ route('readNotification') }}",
                    method: "GET"
                })
            $("#notification_bell").removeClass("text-danger");
        }
        @endif
    </script>
</body>

</html>
