<?php

class SearchController extends Controller
{
    public function getIndex()
    {
        if(!Input::has('query'))
            App::abort(404);
        $cat = (Input::has('search_cat')) ? strtolower(Input::get('search_cat')) : 'companies';
        $possib = array('companies', 'students', 'non profit');
        if(!in_array($cat, $possib)) App::abort(404);
        if($cat == 'companies') {
            $data = array(
                'results' => Adver::where('ads_title', 'like', '%'.Input::get('query').'%')->where('ads_type', 1)->acver()->paginate(10),
                'query' => Input::get('query'),
                'category' => $cat,
            );
            return View::make('search.company', array('data' => $data));
        } elseif($cat == 'non profit') {
            $data = array(
                'results' => Adver::where('ads_title', 'like', '%'.Input::get('query').'%')->where('ads_type', 2)->acver()->paginate(10),
                'query' => Input::get('query'),
                'category' => $cat,
            );
            return View::make('search.company', array('data' => $data));
        } elseif(Auth::user()->notStudent()) {
            $data = array(
                'results' => User::where('u_account_type', 1)->where('name', 'like', '%'.Input::get('query').'%')->paginate(10),
                'query' => Input::get('query'),
                'category' => $cat,
            );
            return View::make('search.student', array('data' => $data));
        }
        App::abort(404);
    }
}
