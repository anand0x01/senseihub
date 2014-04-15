<?php
class StaticController extends Controller
{

    public function getHome()
    {
        return View::make('static.home');
    }

    public function getFaq()
    {
        return View::make('static.faq');
    }

    public function getContact()
    {
        return View::make('static.contact');
    }

    public function getPricing()
    {
        return View::make('static.pricing');
    }

    public function getAbout()
    {
        return View::make('static.about');
    }

    public function getRegister()
    {
        return View::make('static.register');
    }

    public function getStudentRegister()
    {
        return View::make('static.student');
    }

    public function getRecruiterRegister()
    {
        return View::make('static.recruiter');
    }

    public function getCompanyRegister()
    {
        return View::make('static.company');
    }

    public function getLogin()
    {
        return View::make('static.login');
    }

    public function getAddNew()
    {
        return View::make('static.add-new');
    }

    public function getAddCompany()
    {
        $sectors = Config::get('senseihub.sector_names');
        return View::make('static.add-company', array('sectors' => $sectors));
    }

    public function getAddNonProfit()
    {
        $sectors = Config::get('senseihub.sector_names');
        return View::make('static.add-non-profit', array('sectors' => $sectors));
    }
}
