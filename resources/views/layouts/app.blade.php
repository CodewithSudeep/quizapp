<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> QUIZ APP</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="notification" id="notification"></div>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script>
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const showToast = (message,type='') =>{
        $('#notification').html(`<div class="${type=='success'? 'border-green-500 text-green-700' : 'border-red-500 text-red-700'} bg-white p-4 border-l-4 w-full max-w-sm rounded-lg my-4 animate__animated animate__bounce" role="alert">
        <p class="font-bold">${message}</p>
        </div>`);
        $("#notification").show();
        setTimeout(() => {
            $("#notification").html('');
            $("#notification").hide();
        }, 3000);
}
    </script>
        @yield('scripts')
    </body>
</html>
