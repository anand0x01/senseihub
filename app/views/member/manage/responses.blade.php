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
              @if($data['responses']->count() == 0)
                <p><strong class="text-info">No submissions have been made to this project.</strong></p>
              @else
                <div class="clearfix">
                  <div class="">
                    <a type="button" href="#" class="btn btn-success btn-plain">Compare submissions</a>
                  </div>
                </div>
                <hr />
                @foreach ($data['responses'] as $element)
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img class="media-object" width="100px" height="100px" src="{{ URL::asset($element->user->profilePic()) }}" alt="#">
                      </a>
                      <div class="media-body">
                        <a href="#"><h5 class="media-heading text-info">{{ $element->user->getName() }}</h5></a>
                        <p>{{ $element->getMsg() }}</p>
                        <ul class="list-inline">
                          <li><a href="{{ $element->user->resumeLink() }}">Resume</a></li>
                        </ul>
                      </div>
                    </div>
                @endforeach
                {{ $data['responses']->links() }}
              @endif
              </div>
            </div>
        </div>
    </div>
</div>
@stop
