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
                            <p>Select Account Type</p>
                        </div>
                        <div class="stepwizard-step">
                            <button type="button" class="btn btn-default btn-circle">2</button>
                            <p>Create Account</p>
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
                    <label for="inputEmail3" class="col-sm-3 control-label">Account Type</label>
                    <div class="col-sm-9">
                      <select id="fm_s_ss_x" class="form-control">
                          <option value="#">Select One</option>
                          <option value="{{ URL::route('static_reg_student') }}">Student</option>
                          <option value="{{ URL::route('static_reg_rec') }}">Recruiter</option>
                          <option value="{{ URL::route('static_reg_comp') }}">Company</option>
                          <!-- <option value="#">Students</option> -->
                        </select>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
