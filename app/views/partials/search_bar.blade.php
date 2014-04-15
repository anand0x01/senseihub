<div class="row">
  <div class="col-xs-12 col-md-9 center-block">
    <div class="input-group">
        <input type="text" placeholder="Search for anything" class="form-control">
        <div class="input-group-btn">
          <button type="button" class="btn btn-default dropdown-toggle reset_radius" data-toggle="dropdown"><span id="main_s_r_dt">Companies</span> <span class="caret"></span></button>
          <input type="hidden" id="search_cat_s_val" name="search_cat" value="companies" />
          <ul id="main_s_r_dd" class="dropdown-menu pull-right">
            <li><a href="#">Companies</a></li>
            <li><a href="#">Non Profit</a></li>
            @if(Auth::user()->notStudent())
            <li><a href="#">Students</a></li>
            @endif
          </ul>
          <button class="btn btn-default" type="button">Go!</button>
        </div><!-- /btn-group -->
      </div><!-- /input-group -->
  </div>
</div>
