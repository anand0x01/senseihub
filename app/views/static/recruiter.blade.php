@extends('layouts.forms')
@section('content')
<div class="main_step_wizard">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="stepwizard">
                    <div class="stepwizard-row">
                        <div class="stepwizard-step">
                            <a type="button" href="{{ URL::route('static_register') }}" class="btn btn-default btn-circle">1</a>
                            <p>Select Account Type</p>
                        </div>
                        <div class="stepwizard-step">
                            <button type="button" class="btn btn-primary btn-circle">2</button>
                            <p>Create Recruiter Account</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-6  custom_form center-block">
            <form method="post" action="#" class="form-horizontal">
                {{ Form::token() }}
              <fieldset>
                <div class="form-group">
                  <label for="inputUserName" class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-10">
                  {{ Form::text('inputUserName', Input::old('inputUserName'), array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off' , 'placeholder' => 'Enter your name')) }}
                  @if($errors->has('inputUserName'))
                  {{ $errors->first('inputUserName', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                  @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-10">
                  {{ Form::email('inputEmail', Input::old('inputEmail'), array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter email', 'required' => 'required')) }}
                    @if($errors->has('inputEmail'))
                    {{ $errors->first('inputEmail', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" >
                    @if($errors->has('inputPassword'))
                        {{ $errors->first('inputPassword', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                    @endif
                    <span class="help-block"><small class='text-info'>The password should be at least seven characters long</small></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-lg-2 control-label">Password Again</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="inputPasswordR" name="inputPasswordR" placeholder="Password Again"autocomplete="off">
                    @if($errors->has('inputPasswordR'))
                        {{ $errors->first('inputPasswordR', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-3 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary btn-plain">Submit</button>
                  </div>
                </div>
              </fieldset>
            </form>
        </div>
    </div>
</div>
@stop
