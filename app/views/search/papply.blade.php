@extends('layouts.static')
@section('body_class') dashboard_pp_0x @stop
@section('content')
<div class="container dashboard_wrapper p_ad_vw">
  <div class="row">
      <div class="col-xs-12">
        <h4><?php echo $data['adver']->getTitle(); ?></h4>
        <hr />
      </div>
      <div class="col-xs-12 col-sm-2">
        <img class="p_db_i img-responsive" src="{{ URL::asset($data['adver']->getImageUrl()) }}">
      </div>
      <div class="col-xs-12 col-sm-10">
        <p><strong>Sector : </strong><?php echo $data['adver']->sectorName(); ?></p>
        <p><strong>Project Type : </strong><?php echo $data['adver']->projectType(); ?></p>
        <p><strong>Contact : </strong><?php echo $data['adver']->getContact(); ?></p>
        <p><strong>Open for : </strong><?php echo $data['adver']->getDegrees(); ?></p>
        <p><strong>Started On : </strong><?php echo $data['adver']->createdTill(); ?></p>
        <p class="text-success"><strong >Students Needed : </strong><span ><?php echo $data['adver']->studentsNo(); ?></span></p>
      </div>
      <div class="col-xs-12">
        <hr />
        <ul class="nav nav-pills">
          <li><a href="{{ URL::route('ads_pview', $data['adver']->getSludData()) }}">Details</a></li>
          <li class="active"><a href="{{ URL::route('ads_papply', $data['adver']->getSludData()) }}">Apply</a></li>
          <li><a href="{{ URL::route('ads_doubts', $data['adver']->getSludData()) }}">Doubts</a></li>
        </ul>
      </div>
      <div class="col-xs-12 col-md-8 col-md-offset-2">
        <h4>Cover Letter</h4>
        <hr />
        @if(Session::has('applymsg'))
          <div class="alert alert-info alert-plain fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            @if(Session::get('applymsg') == 'true')
            <p><strong>You have already applied in the above project.</strong></p>
            @else
            <p><strong>You have successfully applied for the above project.</strong></p>
            @endif
          </div>
        @endif
        <form action="{{ URL::route('ads_papply', $data['adver']->getSludData()) }}" method="post" accept-charset="utf-8">
          {{ Form::token() }}
          <textarea class="form-control" name="short_summary"  rows="8" placeholder="Write a short summary about why you would be fit for the job. (Optional)">{{ $data['applicationcontent'] }}</textarea>
          <div style="padding-top: 20px;" class="form-group">
            <button type="submit" class="btn btn-primary btn-plain pull-right">Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>
@stop
