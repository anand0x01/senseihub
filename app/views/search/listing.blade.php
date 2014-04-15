@extends('layouts.static')
@section('body_class') dashboard_pp_0x @stop
@section('content')
<div class="search_results_zone">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-9">
        <h4 class="text-info thin_text">Showing from {{ $data['results']->count() }} projects.</h4>
        <hr />
        @foreach ($data['results'] as $value)
          <div class="media">
              <div class="pull-left">
                  <img class="media-object" width="64px" height="64px" src="{{ URL::asset($value->getImageUrl()) }}" alt=".media-object">
              </div>
              <div class="media-body">
                  <h4 class="media-heading"><a href="{{ URL::route('ads_pview', $value->getSludData()) }}" class="thin_text h4_link" title="">{{ $value->getTitle() }}</a></h4>
                  {{ $value->formattedDesc(200) }}
              </div>
          </div>
          <hr />
        @endforeach
        {{ $data['results']->links() }}
      </div>
    </div>
  </div>
</div>
@stop
