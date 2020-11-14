<!DOCTYPE html>
<html>
<head>
    @include('layout.css')
    @yield('css')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="main-background">

    @include('layout.header')

    <a href="{{route('aboutUs')}}" type="button" class="btn btn-outline-info btn-about-us" style="z-index: 1;">About us</a>

    @yield('content')

    @include('layout.js')
    @yield('js')

    <script>
        $('#search').keyup(function () {
            var keyword = $(this).val();
            if (keyword != '') {
                $.ajax({
                    url: "{{ route('ajaxSearch') }}",
                    method: "GET",
                    data: {
                        keyword
                    },
                    success: function (data) {
						if(data!=""){
                            $('#result_list').empty();
							$('#result_list').html(data);
							$('#result_list').show();
						}
						else{
                            $('#result_list').hide();
                        }
                    }
                })
            }
			else{
                $('#result_list').hide();
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

        const httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', '{{ route('totalNotification') }}');
        httpRequest.responseType = 'json';
        httpRequest.onload = () => {
            const data = httpRequest.response;
            document.querySelector('#unread_notification').innerHTML = data;
        }
        httpRequest.send();
        @endif
    </script>
<script src="{{asset('/js/index.js')}}">

</script>
</body>

</html>
