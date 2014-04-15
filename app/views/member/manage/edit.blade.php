@extends('layouts.dashboard')
@section('content')
<div class="dashboard_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                @include('partials.rec_side')
            </div>
            <div class="col-xs-9 ox_cont">
              <h3 class="thin_text small_heading">{{ $data['adver']->getTitle() }}</h3>
              <hr class="small_line" />
              @include('partials.manage_pills', array('hash' => $data['hash']))
              <div class="main_ss_m_cont">
                @if(Session::has('success'))
                <div class="alert alert-dismissable alert-well">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>Congratulation!</strong> Details have been updated.</a>.
                </div>
                @endif
                <div class="row">
                  <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="{{  URL::route('manage_edit', array($data['hash'])) }}">
                    {{ Form::token() }}
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Title <span class="text-info">*</span></label>
                      <div class="col-sm-9">
                        {{ Form::text('title', $data['adver']->getTitle(), array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off' , 'placeholder' => 'Title of the ad', 'maxlength' => '256')) }}
                        @if($errors->has('title'))
                        {{ $errors->first('title', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Sector <span class="text-info">*</span></label>
                      <div class="col-sm-9">
                        {{ Form::select('cp_sector', $data['sectors'], $data['adver']->ads_sector, array('class' => 'form-control')) }}
                        @if($errors->has('cp_sector'))
                        {{ $errors->first('cp_sector', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Project Type <span class="text-info">*</span></label>
                      <div class="col-sm-9">
                          <div class="checkbox">
                            <label>
                              {{ Form::checkbox('project_type[]', 't_s_m', $data['adver']->ads_ptype['sales&m'] == 1) }}
                              Sales and Marketing
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              {{ Form::checkbox('project_type[]', 't_m_r', $data['adver']->ads_ptype['marketing'] == 1) }}
                              Market Research
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              {{ Form::checkbox('project_type[]', 't_p_d', $data['adver']->ads_ptype['productdev'] == 1) }}
                              Product Development
                            </label>
                          </div>
                          @if($errors->has('project_type'))
                          {{ $errors->first('project_type', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Description/Keywords <span class="text-info">*</span></label>
                      <div class="col-sm-9">
                        {{ Form::textarea('description', $data['adver']->ads_meta['description'], array('class' => 'form-control', 'rows' => '6', 'required' => 'required')) }}
                        @if($errors->has('description'))
                        {{ $errors->first('description', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Project Contact Phone Number</label>
                      <div class="col-sm-9">
                       {{ Form::text('phone', $data['adver']->ads_contact, array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off' , 'placeholder' => 'Phone number', 'maxlength' => '30')) }}
                        <span class="help-text"><small class="text-info">We use software to create collaboration rooms using your phone number in the E.164 format and our toll free number. You can learn more in our FAQs. Your information will never be shared with anyone.</small></span>
                        @if($errors->has('phone'))
                        {{ $errors->first('phone', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Degree Level</label>
                      <div class="col-sm-9">
                          <div class="checkbox">
                            <label>
                              {{ Form::checkbox('degree[]', 'd_u', $data['adver']->ads_degree['undergrad'] == 1) }}
                              Undergrad
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              {{ Form::checkbox('degree[]', 'd_g', $data['adver']->ads_degree['grad'] == 1) }}
                              Grad
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              {{ Form::checkbox('degree[]', 'd_p', $data['adver']->ads_degree['phd'] == 1) }}
                              PHD
                            </label>
                          </div>
                          @if($errors->has('degree'))
                          {{ $errors->first('degree', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Images</label>
                      <div class="col-sm-9">
                        {{ Form::file('images') }}
                        @if(isset($data['adver']->ads_meta['image']))
                        <span class="help-block">
                          <img style="max-height: 200px;" src="{{ URL::asset($data['adver']->ads_meta['image']) }}">
                        </span>
                        @endif
                        <span class="help-block"><small class="text-info">Maximum file size: 10240 KB.</small></span>
                        @if($errors->has('images'))
                        {{ $errors->first('images', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Number of students <span class="text-info">*</span></label>
                      <div class="col-sm-9">
                        {{ Form::text('n_stu', $data['adver']->ads_meta['studentsn'], array('class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off' , 'placeholder' => 'Number of students', 'maxlength' => '3')) }}
                        @if($errors->has('n_stu'))
                        {{ $errors->first('n_stu', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary btn-plain">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@stop
