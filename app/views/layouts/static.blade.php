<!DOCTYPE html>
<!--[if IE 8 ]>    <html class="ie8" lang="en-US"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" lang="en-US"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en-US"> <!--<![endif]-->
 <head>
 <meta charset="utf-8">
 <title>@yield('title', 'SenseiHub')</title>
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <meta name="viewport" content="width=device-width">
 <meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
 tempor incididunt ut "/>
 <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
 @yield('meta')
 {{ HTML::style('css/app.css') }}
 {{ HTML::style('css/c_v1.css') }}
 @yield('styles')
 </head>
 <body class="@yield('body_class')">
 @include('partials.navbar')
 @yield('content')
 @include('partials.footer')
 </body>
 {{ HTML::script('js/jquery.min.js') }}
 {{ HTML::script('js/bootstrap.min.js') }}
 {{ HTML::script('js/app.v2.js') }}
 @if(Auth::check() && Auth::user()->notStudent())
 {{ HTML::script('js/app.v3.js') }}
 @endif
 @yield('after_scripts')
</html>
