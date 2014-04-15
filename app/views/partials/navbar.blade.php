<div class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::route('static_home') }}"><!-- <img src="{{ URL::asset('media/img/ccfecaef28a384b98aae9075925df27f.png') }}"> -->SenseiHub</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
      <ul class="nav navbar-nav">
        @if(Auth::check())
        <li class=""><a href="{{ URL::route('ads_listing') }}">Listings</a></li>
        @endif
        <li class=""><a href="{{ URL::route('static_faq') }}">FAQ'S</a></li>
        <li><a href="{{ URL::route('static_contact') }}">Contact Us</a></li>
        <li><a href="{{ URL::route('static_pricing') }}">Pricing</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       @if(Auth::check())
          @if(Auth::user()->notStudent())
          <li><a href="#" data-toggle="modal" data-target="#list_nav_modal" title="List to be shortlisted">List <sup><span id="nav_ll_count" class="label label-success">0</span></sup></a></li>
          @endif
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="" data-toggle="dropdown">{{ Auth::user()->name }}<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{ URL::route('mem_dashboard') }}">Dashboard</a></li>
              <li><a href="#">Settings</a></li>
              <li class="divider"></li>
              <li><a href="{{ URL::route('auth_logout') }}">Logout</a></li>
            </ul>
          </li>
       @else
          <li><a href="{{ URL::route('static_register') }}">Register</a></li>
          <li><a href="{{ URL::route('auth_login') }}">Login</a></li>
       @endif
      </ul>
    </div>
  </div>
</div>
@if(Auth::check() && Auth::user()->notStudent())
<div class="modal fade" furl="{{ URL::route('list_get') }}" faddurl="{{ URL::route('list_add') }}" frmvurl="{{ URL::route('list_remove') }}" id="list_nav_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">List of your selected students</h4>
      </div>
      <div class="modal-body">
        <ul id="nav_ll_ul_main" class="list-unstyled">
          <!-- <li>
           <div class="media">
               <a class="pull-left" href="#">
                   <img class="media-object" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" alt=".media-object">
               </a>
               <div class="media-body">
                   <div class="clearfix">
                     <h4 class="media-heading pull-left">anandms91</h4>
                     <a href="#" class="pull-right">Remove</a>
                   </div>
                   <ul class="list-unstyled">
                     <li><strong>College :</strong> IIT Roorkee</li>
                     <li><strong>Degree :</strong> Undergraduate</li>
                   </ul>
               </div>
           </div>
           <hr />
          </li> -->
        </ul>
      </div>
      <div class="modal-footer">
        <a type="button" id="modConfBtn" href="{{ URL::route('dash_cl') }}" class="btn btn-primary btn-plain">Confirm</a>
      </div>
    </div>
  </div>
</div>
@endif
