@extends('layouts.static')
@section('content')
<div id="home_top_intro" class="xyz">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9 center-block">
                <h3 class="text-center text_top_intro">A marketplace for 20hr/1week projects between growing organisations and students from leading universities globally</h3>
                <h1 class="text-center"><button type="button" class="btn  btn-default btn-lg">Learn More</button></h1>
            </div>
        </div>
    </div>
</div>
<div id="home_mid_search">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 col-sm-7 center-block">
                    <h4 class="text-info intro_search_bar thin_text">Search for students, companies or non-profits.</h4>
                    <form method="get" action="{{ URL::route('search_page') }}" >
                        <div class="input-group">
                          <input type="text" name="query" placeholder="Search for anything" class="form-control">
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle reset_radius" data-toggle="dropdown"><span id="main_s_r_dt">Companies</span> <span class="caret"></span></button>
                            <input type="hidden" id="search_cat_s_val" name="search_cat" value="companies" />
                            <ul id="main_s_r_dd" class="dropdown-menu pull-right">
                              <li><a href="#">Companies</a></li>
                              <li><a href="#">Non Profit</a></li>
                              @if(Auth::check() && Auth::user()->notStudent())
                              <li><a href="#">Students</a></li>
                              @endif
                            </ul>
                            <button class="btn btn-default" type="submit">Go!</button>
                          </div><!-- /btn-group -->
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home_white_desc">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="text-info text-center thin_text">We contribute to the <a href="http://www.malalafund.org/" target="_blank">Malala Fund</a> each time a project is completed</h3>
            </div>
        </div>
    </div>
</div>
@stop
