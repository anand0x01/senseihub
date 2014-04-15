@extends('layouts.dashboard')
@section('content')
<div class="dashboard_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                @include('partials.rec_side')
            </div>
            <div class="col-md-9 ox_cont">
                <h3 class="thin_text small_heading">Change Password</h3>
                <hr class="small_line" />
                @if(Session::has('up_p'))
                <div class="alert alert-dismissable alert-well">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Congratulation!</strong> Your password has been succesfully updated.</a>.
                </div>
                @endif
                <form method="post" action="{{ URL::route('mem_chng_pass') }}" class="form-horizontal main_step_content">
                    {{ Form::token() }}
                    <fieldset>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Current Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="cPassword" name="cPassword" placeholder="Current Password" required>
                                @if($errors->has('cPassword'))
                                {{ $errors->first('cPassword', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">New Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="nPassword" name="nPassword" placeholder="New Password" required>
                                @if($errors->has('nPassword'))
                                {{ $errors->first('nPassword', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">New Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="nPasswordr" name="nPasswordr" placeholder="Repeat New Password" required>
                                @if($errors->has('nPasswordr'))
                                {{ $errors->first('nPasswordr', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
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
</div>
@stop
