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
            <li><a style='color:#255625;' href="/"><i class="fa fa-home"></i> Home</a></li>
<!--            <li><a style='color:#255625;'  href="/about"><i class="fa fa-info"></i> About</a></li>-->
            <li><a style='color:#255625;' href="/contact"><i class="fa fa-comments-o"></i> Contact</a></li>
              <li><a style='color:#255625;' href="{{url('/student/departments/notifications')}}"><i class="fa fa-bell"></i> Notifications</a></li>
           
            <li><a style='color:#255625;' href="{{url('payment')}}"><i class="fa fa-bank"></i> Payment Instructions</a></li>
             @if (Auth::guest())
              @else
               <li><a style='color:#255625;' href="{{url('student/settings')}}"><i class="fa fa-gear"></i> Settings</a></li>
              @endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                            
                         
         
                        @else
                           <li>
                                        <a style='color:#255625;' href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           <i class="fa fa-signing"></i> Logout
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