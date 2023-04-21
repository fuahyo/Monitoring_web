
<ul class=" navbar-nav bg-gradient-danger sidebar sidebar-dark ">
    <nav class="nav nav-pills flex-column">
        <div class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <div class="sidebar-brand-text mr-3">
                <a href="/dashboard"><img src="/img/logoperusahaan.PNG" alt="" style="width: 80%" href="/dashboard"> </a>
            </div>
            <div>
                <button class="rounded-circle border-0 mt-3" id="sidebarToggle"></button>
            </div>
        </div>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class=" nav-link {{ Request::is('dashboard') ? 'active bg-dark' : '' }}" aria-current="page" href="/dashboard" >
                <i class="fas fa-fw fa-table"></i>
                <span>Dashboard</span></a>
            </a>
        </li>
        @if(auth()->user()->role_id == '1')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/mypost*') ? 'active bg-dark' : '' }}" aria-current="page" href="/dashboard/mypost">
              <i class="fas fa fa-file"></i>
              <span >My CAPA</span>
              
            </a>
        </li>
        @endif
        @if(auth()->user()->role_id != '1')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/mydepartementpost*') ? 'active bg-dark' : '' }}" aria-current="page" href="/dashboard/mydepartementpost">
              <i class="fas fa fa-file"></i>
              <span >My Dept CAPA</span>
              
            </a>
        </li>
        @endif

        <hr class="sidebar-divider px-3 mt-4">
        @if(auth()->user()->role_id == '3')
        <div class="sidebar-heading text-center align-items-center  mb-1 ">
            Admin
        </div>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/chart*') ? 'active bg-dark' : '' }}" href="/dashboard/chart">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Report</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active bg-dark' : '' }}" href="/dashboard/posts" >
                <i class="fas fa-fw fa-folder"></i>
                <span>All CAPA</span>
            </a> 
        </li>

        <li class="nav-item">    
            <a class="nav-link {{ Request::is('dashboard/users*') ? 'active bg-dark' : '' }}" aria-current="page" href="/dashboard/users">
              <i class="fa fa-user"></i>
              <span>All Users</span>
              
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        @endif
    </nav>
</ul>