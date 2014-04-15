<?php

class AuthController extends Controller
{
    public function anyLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::route(Config::get('senseihub.logout_redirect'));
    }
}
