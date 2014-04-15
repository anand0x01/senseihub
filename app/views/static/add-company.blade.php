@extends('layouts.forms')
@section('content')
<div class="main_step_wizard">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="stepwizard">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-success btn-circle">1</button>
                    <p>Select Category</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" class="btn btn-primary btn-circle">2</button>
                    <p>Company Details</p>
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
<div class="main_step_content">
  <div class="container">
    <div class="row">
      <div class="col-xs-7 center-block">
        <form action="{{ URL::route('add_company') }}" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
          {{ Form::token() }}
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Category</label>
              <div class="col-sm-8">
                <p class="form-control-static">Company <a href="{{ URL::route('add_new') }}"><small>(change)</small></a></p>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Title <span class="text-info">*</span></label>
              <div class="col-sm-8">
                {{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off' , 'placeholder' => 'Title of the ad', 'maxlength' => '256')) }}
                @if($errors->has('title'))
                {{ $errors->first('title', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Sector <span class="text-info">*</span></label>
              <div class="col-sm-8">
                {{ Form::select('cp_sector', $sectors, Input::old('cp_sector'), array('class' => 'form-control')) }}
                @if($errors->has('cp_sector'))
                {{ $errors->first('cp_sector', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Project Type <span class="text-info">*</span></label>
              <div class="col-sm-8">
                  <div class="checkbox">
                    <?php $_ptypes = Input::old('project_type', array()); ?>
                    <label>
                      {{ Form::checkbox('project_type[]', 't_s_m', in_array('t_s_m', $_ptypes)) }}
                      Sales and Marketing
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox('project_type[]', 't_m_r', in_array('t_m_r', $_ptypes)) }}
                      Market Research
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox('project_type[]', 't_p_d', in_array('t_p_d', $_ptypes)) }}
                      Product Development
                    </label>
                  </div>
                  @if($errors->has('project_type'))
                  {{ $errors->first('project_type', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                  @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Description/Keywords <span class="text-info">*</span></label>
              <div class="col-sm-8">
                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control', 'rows' => '6', 'required' => 'required')) }}
                @if($errors->has('description'))
                {{ $errors->first('description', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Project Contact Phone Number</label>
              <div class="col-sm-8">
               {{ Form::text('phone', Input::old('phone'), array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off' , 'placeholder' => 'Phone number', 'maxlength' => '30')) }}
                <span class="help-text"><small class="text-info">We use software to create collaboration rooms using your phone number in the E.164 format and our toll free number. You can learn more in our FAQs. Your information will never be shared with anyone.</small></span>
                @if($errors->has('phone'))
                {{ $errors->first('phone', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Degree Level</label>
              <div class="col-sm-8">
                  <div class="checkbox">
                   <?php $_degree = Input::old('degree', array('d_u', 'd_g', 'd_p')); ?>
                    <label>
                      {{ Form::checkbox('degree[]', 'd_u', in_array('d_u', $_degree)) }}
                      Undergrad
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox('degree[]', 'd_g', in_array('d_g', $_degree)) }}
                      Grad
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox('degree[]', 'd_p', in_array('d_p', $_degree)) }}
                      PHD
                    </label>
                  </div>
                  @if($errors->has('degree'))
                  {{ $errors->first('degree', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                  @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Images</label>
              <div class="col-sm-8">
                {{ Form::file('images') }}
                <span class="help-block"><small class="text-info">You are allowed to upload 10 file(s). Maximum file size: 10240 KB.</small></span>
                @if($errors->has('images'))
                {{ $errors->first('images', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Number of students needed<span class="text-info">*</span></label>
              <div class="col-sm-8">
              {{ Form::text('n_stu', Input::old('n_stu'), array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off' , 'placeholder' => 'Number of students', 'maxlength' => '3')) }}
                @if($errors->has('n_stu'))
                {{ $errors->first('n_stu', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                  <p><strong>Rules and Guidelines:</strong></p>
                   <p>By posting your classified ad here, you agree that it is in compliance with our guidelines listed below.</p>
                  <p >We reserve the right to modify any ads in violation of our guidelines order to prevent abuse and keep the content appropriate for our general audience. This includes people of all ages, races, religions, and nationalities. Therefore, all ads that are in violation of our guidelines are subject to being removed immediately and without prior notice.</p>
                  <p >By posting an ad on our site, you agree to the following statement:
                  I agree that I will be solely responsible for the content of any classified ads that I post on this website. I will not hold the owner of this website responsible for any losses or damages to myself or to others that may result directly or indirectly from any ads that I post here.
                  By posting an ad on our site, you further agree to the following guidelines:
                  No foul or otherwise inappropriate language will be tolerated. Ads in violation of this rule are subject to being removed immediately and without warning. If it was a paid ad, no refund will be issues.
                  No racist, hateful, or otherwise offensive comments will be tolerated.
                  No ad promoting activities that are illegal under the current laws of this state or country.
                  Any ad that appears to be merely a test posting, a joke, or otherwise insincere or non-serious is subject to removal.
                  We reserve the ultimate discretion as to which ads, if any, are in violation of these guidelines.
                  Thank you for your understanding.</p>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Continue</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
