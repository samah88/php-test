<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale()=='ar'? 'rtl':'ltr'}}">
<head>
<link rel="stylesheet" href="{{asset('/')}}css/font-awesome.min.css">
<link href="{{asset('/')}}css/style.css" rel="stylesheet" type="text/css" />
<title>@yield('title')</title>
@stack('styles')
</head>
<body>
<main class="container">
@yield('content')
</main>

<script src="{{asset('/')}}js/jquery.min.js"></script>
@stack('scripts')
</body>
</html>


