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
              <li><a  style='color:#255625;' href="/admin/students"><i class="fa fa-home"></i> Students</a></li>
            <li><a  style='color:#255625;' href="/admin/departments"><i class="fa fa-bank"></i> Departments</a></li>
           <li><a  style='color:#255625;' href="/admin/requests"><i class="fa fa-users"></i> Approval Requests</a></li>
           <li><a  style='color:#255625;' href="{{url('admin/finance/report')}}"><i class="fa fa-dollar"></i> Finance Report</a></li>
            <li><a  style='color:#255625;' href="{{url('admin/finance/transactions')}}"><i class="fa fa-file"></i> Transactions</a></li>
            <li><a  style='color:#255625;' href="/admin/acdemics/years"><i class="fa fa-check"></i> Academic years</a></li>
              <li><a  style='color:#255625;' href="/admin/settings"><i class="fa fa-gear"></i> Settings</a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
        
                           <li>
                                        <a  style='color:#255625;' href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-signing"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                               
                        
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>