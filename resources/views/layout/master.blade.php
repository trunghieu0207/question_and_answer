<!DOCTYPE html>
<html>
<head>
    @include('layout.css')
    @yield('css')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style type="text/css" media="screen">
        .scrollbar {
            margin-left: 30px;
            float: left;
            height: 300px;
            width: 350px;
            background: #fff;
            overflow-y: scroll;
            margin-bottom: 50px;
            }




    </style>
</head>
<body class="main-background">

    @include('layout.header')

    <a href="{{route('aboutUs')}}" type="button" class="btn btn-outline-info btn-about-us">About us</a>
    
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
						else{
                            $('#result_list').hide();
                            $('#result_list').empty();
                        }
                    }
                })
            }
			else{
                $('#result_list').hide();
                $('#result_list').empty();
            }
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
            $("#unread_notification").remove();
        }
        @endif
    </script>
</body>

</html>
