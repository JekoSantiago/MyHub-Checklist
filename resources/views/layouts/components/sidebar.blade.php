<div id="slide-out" class="main-sidebar white">
    <div class="main-sidebar-body">
        <div class="logo-wrapper waves-light waves-effect waves-light">
            <a href="#">CHECKLIST</a>
        </div>
        <div class="user-wrapper">
            <div class="user-header d-flex align-items-center">
                <img src="{{asset('assets/images/avatar.jpg')}}" height="35" alt="user jpg">
                <h6 class="ml-2 m-0">{{  base64_decode(Session::get('Emp_Name')) }}</h6>
            </div>
            {{-- <div class="logout">
                <a href="{{ url('/logout') }}" class="waves-effect waves-light">
            <i class="fa fa-power-off" aria-hidden="true"></i> Log out</a>
        </div> --}}
        {{-- <div class="user-navigation">
                
                <a class="waves-effect collapsed" data-toggle="collapse" data-target="#userMenu" aria-expanded="false"
                    aria-controls="userMenu"> User Menu <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
            </div> --}}
        {{-- <div id="userMenu" class="user-dropdown-menu collapse">
                <ul class="navigation">
                    <li><a class="waves-effect" href="#"><i class="fa fa-user" aria-hidden="true"></i> My account</a>
                    </li>
                    <li><a class="waves-effect" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a>
                    </li>
                </ul>
            </div> --}}
    </div>
    <ul class="collapsible-list">
        @php $isActive = ''; Request::segment(1) === 'audit' ? $isActive = 'active' : '' @endphp
        <li class="new-audit {{ $isActive }}">
            <a class="waves-effect waves-light" data-toggle="collapse"
                data-target="#auditMenu" aria-expanded="false" aria-controls="auditMenu">
                <i class="fas fa-folder-plus fa-fw" aria-hidden="true"></i> New Audit <i
                    class="fas fa-chevron-down dropdown-icon" aria-hidden="true"></i>
                </a>
            <div id="auditMenu" class="sidebar-dropdown-menu collapse  {{ $isActive === 'active' ? 'show' : '' }}">
                <ul class="navigation">
                    <li {{ Request::segment(2) === 'location' ? 'class=active' : ''}}>
                        <a class="waves-effect waves-light" href="{{ url('/audit/location') }}"><i class="fas fa-store fa-fw"
                                aria-hidden="true"></i>
                            Store</a>
                        </li>
                    <li {{ Request::segment(2) === 'department' ? 'class=active' : ''}}>
                        <a class="waves-effect waves-light" href="{{ url('/audit/department') }}"><i class="fas fa-building fa-fw"
                                aria-hidden="true"></i> Back
                            Office</a>
                        </li>
                </ul>
            </div>
        </li>
        {{-- <li>
                <a class="waves-effect waves-light" data-toggle="modal" data-target="#modal_answer_cl" >
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Answer Checklist</a>
            </li> --}}
        <li {{ Request::segment(1) === 'myaudit' ? 'class=active' : ''}}>
            <a href="{{ url('/myaudit') }}" class="waves-effect waves-light">
                <i class="fas fa-clipboard-check fa-fw" aria-hidden="true"></i> My Audit</a>
        </li>
        {{-- <li>
                <a href="{{ url('/myanswers') }}" class="waves-effect waves-light">
        <i class="fa fa-list-ul" aria-hidden="true"></i> My Answers</a>
        </li> --}}
        @if( base64_decode(Session::get('Department_ID')) == config('app.store_ops_depID') && base64_decode(Session::get('PositionLevel_ID')) == config('app.rnf_pos_lvl_ID') )
        <li {{ Request::segment(1) === 'acceptance' ? 'class=active' : ''}}>
            <a href="{{ url('/acceptance') }}" class="waves-effect waves-light">
                <i class="fas fa-handshake fa-fw" aria-hidden="true"></i> Audit Acceptance</a>
        </li>
        @endif
        @if( (base64_decode(Session::get('Department_ID')) == config('app.store_ops_depID') && base64_decode(Session::get('PositionLevel_ID')) == config('app.am_pos_lvl_ID')) )
        <li {{ Request::segment(1) === 'myapproval' ? 'class=active' : ''}}>
            <a href="{{ url('/myapproval') }}" class="waves-effect waves-light">
                <i class="fas fa-thumbs-up fa-fw" aria-hidden="true"></i> My Approval</a>
        </li>
        @endif
        @if( base64_decode(Session::get('Department_ID')) == config('app.store_ops_depID') && base64_decode(Session::get('PositionLevel_ID')) == config('app.sup_pos_lvl_ID') )
        <li {{ Request::segment(1) === 'rca' ? 'class=active' : ''}}>
            <a href="{{ url('/rca') }}" class="waves-effect waves-light">
                <i class="fas fa-comment-dots fa-fw" aria-hidden="true"></i> RCA</a>
        </li>
        @endif
        @if( base64_decode(Session::get('Department_ID')) == config('app.qa_depID') )
        <li {{ Request::segment(1) === 'reports' ? 'class=active' : ''}}>
            <a href="{{ url('/reports') }}" class="waves-effect waves-light">
                <i class="fas fa-chart-pie fa-fw" aria-hidden="true"></i> Reports</a>
        </li>
        @endif
        @if( base64_decode(Session::get('Department_ID')) == config('app.qa_depID') && 
           ( base64_decode(Session::get('PositionLevel_ID')) == config('app.am_pos_lvl_ID') || base64_decode(Session::get('PositionLevel_ID')) == config('app.sm_pos_lvl_ID') ) )
        <li {{ Request::segment(1) === 'maintenance' ? 'class=active' : ''}}>
            <a href="{{ url('/maintenance/checklist') }}" class="waves-effect waves-light">
                <i class="fas fa-cog fa-fw" aria-hidden="true"></i> Maintenance</a>
        </li>
        @endif
        <li>
            <a href="{{ url('/logout') }}" class="waves-effect waves-light">
                <i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i> Logout</a>
        </li>
    </ul>
    </div>
</div>
<div class="side-bar-backdrop"></div>