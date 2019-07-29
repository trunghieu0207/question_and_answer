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

<<<<<<< HEAD
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@yield('script')
=======
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
    </script>
>>>>>>> 0c65e0dc4ef1f87f15bdb4b42841df8521da25a0
</body>

</html>
