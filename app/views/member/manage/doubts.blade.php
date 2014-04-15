@extends('layouts.dashboard')
@section('body_class') dashboard_pp_0x @stop
@section('content')
<div class="modal fade" id="myQuesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="clearfix">
          <h4 class="modal-title pull-left">Write Answer</h4>
          <!-- <a href="#" id="myQuesModalDel" delLink="#" class="btn btn-link pull-right">Delete Question</a> -->
        </div>
      </div>
      <div class="modal-body">
        <p><strong id="myQuesModalQues">Do the levels that include your solo catalog include "Swim For It"? That's one I've never had my hands on, so I'd gladly go for it</strong></p>
        <textarea id="myQuesModalTextArea" placeholder="Write your answer" class="form-control" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-plain" data-dismiss="modal">Close</button>
        <button quesId="#" id="myQuesModalSave" furl="{{ URL::route('manage_h_answer', array($data['hash'])) }}" type="button" class="btn btn-primary btn-plain">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="dashboard_wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-4 col-md-3">
        @include('partials.rec_side')
      </div>
      <div class="col-xs-12  col-sm-8 col-md-9 ox_cont">
        <h3 class="thin_text small_heading">{{ $data['adver']->getTitle() }}</h3>
        <hr class="small_line" />
        @include('partials.manage_pills', array('hash' => $data['hash']))
        <div class="main_ss_m_cont">
          @if(count($data['doubts']) == 0)
          <h5 class="text-info">No doubts have been asked for your project.</h5>
          @else
          <h4 class="thin_text">Unanswered Questions</h4>
          <hr class="small_line" />
          @if(count($data['unsolved']))
          <ol>
          @foreach ($data['unsolved'] as $ques)
            <li>
              <p><a qid="{{ $ques->getId() }}" class="dbt_uns_ques" href="#"><strong >{{ $ques->getQuestion() }}</strong></a></p>
            </li>
          @endforeach
          </ol>
          @endif
          <hr />
          <h4 class="thin_text">Answered Questions</h4>
          <hr class="small_line" />
          @if(count($data['solved']))
          <ol>
          @foreach ($data['solved'] as $ques)
            <li>
              <p><a class="db_ans_ques" href="#"><strong >{{ $ques->getQuestion() }}</strong></a></p>
              {{ $ques->getAnswer() }}
            </li>
          @endforeach
          </ol>
          @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Main footer -->
@stop
