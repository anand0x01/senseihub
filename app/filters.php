<?php

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest(route('auth_login'));
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

Route::filter('csrf', function()
{
    $token = (Request::ajax()) ? Request::header('X-CSRF-Token') : Input::get('_token');
    if (Session::token() != $token)
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

Route::filter('hr_company', function()
{
    if(!Auth::check() || Auth::user()->u_account_type == 1)
        App::abort(404);
});

Route::filter('student_ch', function()
{
    if(Auth::user()->u_account_type != 1)
        App::abort(403, 'Unauthorized action');
});

Route::filter('ajax', function()
{
    if(!Request::ajax()) App::abort(404);
});
