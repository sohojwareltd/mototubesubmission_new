<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{setting('site.title')}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/flatpicker.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css'>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
</head>

<body>
    @yield('above_header')
    <header class="page-header wow fadeInDown" data-wow-delay="0.1s">
        <div class="container">
            <div class="header-flex">
                <a href="{{route('home')}}" class="header-logo">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </a>
            </div>
        </div>
    </header>
    @yield('content')

   <x-service />
   <x-submission />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="{{asset('js/flatpicker.js')}}"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
    @yield('javascript')
</body>

</html>
