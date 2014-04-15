<?php

Route::pattern('hash', '[0-9a-zA-Z]+');
Route::pattern('slug', '[a-z0-9-]+');

// All static page routes
Route::get('/', array('as' => 'static_home', 'uses' => 'StaticController@getHome'));
Route::get('/faq', array('as' => 'static_faq', 'uses' => 'StaticController@getFaq'));
Route::get('/contact', array('as' => 'static_contact', 'uses' => 'StaticController@getContact'));
Route::get('/pricing', array('as' => 'static_pricing', 'uses' => 'StaticController@getPricing'));
Route::get('/about', array('as' => 'static_about', 'uses' => 'StaticController@getAbout'));
Route::get('/search', array('as' => 'search_page', 'uses' => 'SearchController@getIndex'));

// Auth routes
Route::get('/login', array('as' => 'auth_login', 'uses' => 'StaticController@getLogin', 'before' => 'guest'));
Route::post('/login', array('uses' => 'ValidationController@postLogin', 'before' => 'guest'));
Route::group(array('prefix' => '/register', 'before' => 'guest'), function ()
{
    Route::get('/', array('as' => 'static_register', 'uses' => 'StaticController@getRegister'));
    Route::get('/student', array('as' => 'static_reg_student', 'uses' => 'StaticController@getStudentRegister'));
    Route::get('/recruiter', array('as' => 'static_reg_rec', 'uses' => 'StaticController@getRecruiterRegister'));
    Route::get('/company', array('as' => 'static_reg_comp', 'uses' => 'StaticController@getCompanyRegister'));
    Route::group(array('before' => 'csrf'), function()
    {
        Route::post('/student', array('uses' => 'ValidationController@signupStudent'));
        Route::post('/recruiter', array('uses' => 'ValidationController@signupRecruiter'));
        Route::post('/company', array('uses' => 'ValidationController@signupCompany'));
    });
});

// User control urls.
Route::group(array('before' => 'auth'), function()
{
    Route::any('/logout', array('as' => 'auth_logout', 'uses' => 'AuthController@anyLogout'));
    Route::group(array('prefix' => '/dashboard'), function()
    {
        Route::get('/', array('as' => 'mem_dashboard', 'uses' => 'MemberController@getDashboard'));
        Route::get('/change-password', array('as' => 'mem_chng_pass', 'uses' => 'MemberController@getCPassword'));
        Route::post('/change-password', array('uses' => 'ValidationController@postCPassword'));
        Route::get('/current-list', array('as' => 'dash_cl' ,'uses' => 'MemberController@getCList', 'before' => 'hr_company'));
        Route::post('/current-list', array('uses' => 'ValidationController@postCList', 'before' => 'csrf|hr_company'));
        Route::group(array('before' => 'hr_company', 'prefix' => '/lists'), function()
        {
            Route::get('/', array('as' => 'dash_mem_lists', 'uses' => 'MemberController@getDbLists'));
            Route::get('/{hash}', array('as' => 'dash_list_mng', 'uses' => 'MemberController@getMngList'));
        });
        Route::group(array('prefix' => '/manage/{hash}'), function()
        {
            Route::get('/', array('as' => 'manage_hash', 'uses' => 'ManageController@getIndex'));
            Route::get('/responses', array('as' => 'manage_h_reponses', 'uses' => 'ManageController@getResponses'));
            Route::get('/doubts', array('as' => 'manage_h_doubts', 'uses' => 'ManageController@getDoubts'));
            Route::post('/answer', array('as' => 'manage_h_answer', 'uses' => 'ManageController@postAnswer', 'before' => 'csrf|ajax'));
            Route::get('/edit', array('as' => 'manage_edit', 'uses' => 'ManageController@getEdit'));
            Route::post('/edit', array('uses' => 'ValidationController@editProject', 'before' => 'csrf'));
        });
    });
    Route::group(array('prefix' => '/ads'), function()
    {
        Route::get('/', array('as' => 'ads_listing', 'uses' => 'AdsController@getListing'));
        Route::group(array('prefix' => '{hash}/{slug}'), function()
        {
            Route::get('/', array('as' => 'ads_pview', 'uses' => 'AdsController@getPView'));
            Route::get('/apply', array('as' => 'ads_papply', 'uses' => 'AdsController@getPApply', 'before' => 'student_ch'));
            Route::post('/apply', array('uses' => 'AdsController@postPApply', 'before' => 'student_ch|csrf'));
            Route::get('/doubts', array('as' => 'ads_doubts', 'uses' => 'AdsController@getPDoubts', 'before' => 'student_ch'));
            Route::post('/doubts', array('uses' => 'AdsController@postPDoubts', 'before' => 'student_ch|ajax|csrf'));
        });
    });
});

// add new
Route::group(array('before' => 'auth|hr_company', 'prefix' => '/add-new'), function()
{
    Route::get('/', array('as' => 'add_new', 'uses' => 'StaticController@getAddNew'));
    Route::get('/company', array('as' => 'add_company', 'uses' => 'StaticController@getAddCompany'));
    Route::post('/company', array('uses' => 'ValidationController@newAdCompany', 'before' => 'csrf'));
    Route::get('/non-profit', array('as' => 'add_non_profit', 'uses' => 'StaticController@getAddNonProfit'));
    Route::post('/non-profit', array('uses' => 'ValidationController@newNonProfit'));
});

Route::group(array('before' => 'csrf|hr_company', 'prefix' => '/list'), function()
{
    Route::post('/get', array('as' => 'list_get', 'uses' => 'MemberController@getList'));
    Route::post('/add', array('as' => 'list_add', 'uses' => 'MemberController@addList'));
    Route::post('/remove', array('as' => 'list_remove', 'uses' => 'MemberController@removeList'));
});

Route::get('/test', function()
{

});
