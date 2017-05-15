   <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed"  style="background-color:#255625 !important;"
                  data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span style="background-color:#fff !important;" class="icon-bar"></span>
            <span  style="background-color:#fff !important;" class="icon-bar"></span>
            <span  style="background-color:#fff !important;" class="icon-bar"></span>
          </button>
          <a style='color:#255625;' class="navbar-brand" href="/">Clearance</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a style='color:#255625;' href="/home"><i class="fa fa-home"></i> Home</a></li>
             
              <li><a style='color:#255625;' href="{{url('/department/add/claim')}}"><i class="fa fa-pencil"></i>  Add Claim</a></li>
        @if(auth()->user()->department=='1')
        <li><a style='color:#255625;' href="{{url('/department/courses')}}"><i class="fa fa-globe"></i> Courses</a></li>
         @endif
          <li class="dropdown">
              <a style='color:#255625;' href="#" class="dropdown-toggle" data-toggle="dropdown"
                 role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-comments-o"></i> Messages<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a style='color:#255625;' href="{{url('department/messages')}}"><i class="fa fa-comments-o"></i> Messages</a></li>
                <li><a style='color:#255625;' href="{{url('department/notifications')}}"><i class="fa fa-bell"></i> Notifications</a></li>
               
                <li role="separator" class="divider"></li>
                 <li><a style='color:#255625;' href="{{url('department/messages/bulk')}}"><i class="fa fa-file"></i> Bulk Messages</a></li>
              </ul>
            </li>
        
          <li><a style='color:#255625;' href="{{url('/department/settings')}}"><i class="fa fa-gear"></i> Settings</a></li>
         
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                            
             @else
                           <li>
                                        <a style='color:#255625;'  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          <i class="fa fa-signing"></i>   Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                               
                        @endif
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
