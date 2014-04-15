@extends('layouts.dashboard')
@section('content')
<div class="dashboard_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                @include('partials.rec_side')
            </div>
            <div class="col-xs-9 ox_cont">
              <h3 class="thin_text small_heading">Your Lists</h3>
              <hr class="small_line" />
              @if(is_null($data['lists']))
              <p class="text-info"><strong>You haven't created any list yet. Choose students to create a list.</strong></p>
              @else
              <table class="table small_p">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>List Name</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data['lists'] as $index => $row)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>
                        <p>{{ $row->l_name }}</p>
                      </td>
                      <td>
                        <p><a href="{{ URL::route('dash_list_mng', array($row->_id)) }}">Manage</a></p>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
              @endif
            </div>
        </div>
    </div>
</div>
@stop
