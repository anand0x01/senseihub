@extends('layouts.dashboard')
@section('content')
<div class="dashboard_wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-3">
        @include('partials.rec_side')
      </div>
      <div class="col-xs-9 ox_cont">
        <h3 class="thin_text small_heading">You current shortlist</h3>
        <hr class="small_line" />
        <?php if(!empty($data['users'])): ?>
          <div class="clearfix">
            <p class="text-info"><strong>You can send an message to all these students a personal message as well as an email will be sent to their email adresses. You can compose a message in the box below describing the nature of work and your expectations and the students will reply back by accepting those invitations.</strong></p>
            <form action="{{ URL::route('dash_cl') }}" class="" method="post" accept-charset="utf-8">
              {{ Form::token() }}
              <div class="form-group">
                  <label for="exampleInputEmail1">Name of the project</label>
                  <input type="text" class="form-control" value="{{ Input::old('projectname') }}" name="projectname" id="exampleInputEmail1" required placeholder="Project name">
                  @if($errors->has('projectname'))
                  {{ $errors->first('projectname', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                  @endif
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Invitation Letter</label>
                  <textarea placeholder="Write invitation letter" name="invletter" class="form-control" required rows="8">{{ Input::old('invletter') }}</textarea>
                  @if($errors->has('invletter'))
                  {{ $errors->first('invletter', '<span class="help-block"><small class="text-danger">:message</small></span>') }}
                  @endif
              </div>
              <button style="margin-top: 10px;"  type="submit" class="btn btn-primary btn-plain pull-right">Send invitation</button>
            </form>
          </div>
        <?php else: ?>
          <h4 class="text-danger">There is no one currently in your list please add some to your list to invite people.</h4>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
@stop
