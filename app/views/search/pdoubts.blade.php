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
          <li><a href="{{ URL::route('ads_papply', $data['adver']->getSludData()) }}">Apply</a></li>
          <li class="active"><a href="{{ URL::route('ads_doubts', $data['adver']->getSludData()) }}">Doubts</a></li>
        </ul>
        <div class="p_ad_tx">
          <div class="row">
            <div class="col-xs-12">
              <div class="clearfix">
                <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-primary btn-plain pull-right">Ask Question</button>
              </div>
              <hr />
            </div>
            @if($data['nodoubts'])
            <div class="col-xs-12">
              <p><strong class="text-info">No questions have been asked about this project yet.</strong></p>
            </div>
            @else
              <div class="col-md-6">
                <h4>Answered Questions</h4>
                <hr />
                @if(count($data['solved']))
                <ol>
                  @foreach ($data['solved'] as $element)
                    <li>
                      <p><strong>{{ $element->getQuestion() }}</strong></p>
                      <p><strong>Answer :- </strong><span>{{ $element->getAnswer() }}</span></p>
                    </li>
                  @endforeach
                </ol>
                @endif
              </div>
              <div class="col-md-6">
                <h4>Unanswered Questions</h4>
                <hr />
                @if(count($data['unsolved']))
                <ol>
                  @foreach ($data['unsolved'] as $element)
                    <li>
                      <p><strong>{{ $element->getQuestion() }}</strong></p>
                    </li>
                  @endforeach
                </ol>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
  </div>
</div>
<!-- Ask question modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="clearfix">
          <h4 class="modal-title">Ask Question</h4>
        </div>
      </div>
      <div class="modal-body">
        <p><strong>Make sure the question you are about to ask has not been asked before.</strong></p>
        <textarea id="sbmt_q_mod_txt" placeholder="Write your question..." class="form-control" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-plain" data-dismiss="modal">Close</button>
        <button type="button" pid="{{ $data['adver']->_id }}" pfurl="{{ URL::route('ads_doubts', $data['adver']->getSludData()) }}" id="sbmt_q_mod_btn" class="btn btn-primary btn-plain">Submit Question</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
