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
                <h4 class="">Details</h4>
                <hr class="small_line" />
                <dl class="dl-horizontal">
                  <dt>Status</dt>
                  <dd>{{ $data['adver']->getStatus() }}</dd>
                  <dt>Active Till</dt>
                  <dd>{{ $data['adver']->activeTill() }}</dd>
                  <dt>Created On</dt>
                  <dd>{{ $data['adver']->createdTill() }}</dd>
                  <dt>Total Views</dt>
                  <dd>{{ $data['adver']->aviews()->count() }}</dd>
                  <dt>Total responses</dt>
                  <dd>{{ $data['adver']->aresponse()->count() }}</dd>
                  <dt>Total doubts</dt>
                  <dd>{{ $data['adver']->adoubts()->count() }}</dd>
                </dl>
                <h4 id="dash_ac_head" pid="{{ $data['hash'] }}">Actions</h4>
                <hr class='small_line' />
                @include('partials.manage_buttons', array('btns' => $data['adver']->getActions()))
                <h4>Information</h4>
                <hr class="small_line" />
                <div class="project_dash_box">
                  <div class="row">
                    <div class="col-sm-3">
                        <img class="p_db_i img-responsive" src="{{ URL::asset($data['adver']->getImageUrl()) }}">
                    </div>
                    <div class="col-sm-9">
                      <p><strong>Title : </strong>{{ $data['adver']->getTitle() }}</p>
                      <p><strong>Sectors : </strong>{{ $data['adver']->sectorName() }}</p>
                      <p><strong>Contact : </strong>{{ $data['adver']->getContact() }}</p>
                      <p><strong>Degrees : </strong>{{ $data['adver']->getDegrees() }}</p>
                    </div>
                    <div class="col-xs-12 p_db_dsc">
                      {{ $data['adver']->formattedDesc()  }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@stop
