@extends('layouts.forms')
@section('content')
<div class="main_step_wizard">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="stepwizard">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-primary btn-circle">1</button>
                    <p>Select Category</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-default btn-circle">2</button>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-default btn-circle">3</button>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-default btn-circle">4</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main_step_content select_block">
  <div class="container">
    <div class="row">
      <div class="col-xs-5 center-block">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10">
              <select id="fm_s_ss_x" class="form-control">
              <option value="#">Select One</option>
              <option value="{{ URL::route('add_company') }}">Companies</option>
              <option value="{{ URL::route('add_non_profit') }}">Non Profits</option>
            </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
