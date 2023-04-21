<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-danger sidebar collapse">
    
    <div class="position-sticky pt-3">
        <ul class="nav flex-column mb-5">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <i class="fa fa-calendar"></i>
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            @if(auth()->user()->role_id == '1')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/mypost*') ? 'active' : '' }}" href="/dashboard/mypost">
                <i class="lnr lnr-file-empty"></i>
                <span data-feather="file-text"></span>
                My CAPA
              </a>
            </li>
            @endif
            @if(auth()->user()->role_id != '1')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/mydepartementpost*') ? 'active' : '' }}" href="/dashboard/mydepartementpost">
                <i class="lnr lnr-file-empty"></i>
                <span data-feather="file-text"></span>
                My Dept CAPA
              </a>
            </li>
            @endif
        </ul>

        @if(auth()->user()->role_id == '3')
        <!-- @can('admin') -->
            <h3 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Administrator</span>
            </h3>

            <ul class="nav flex-column mb-5">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/chart*') ? 'active' : '' }}" href="/dashboard/chart">
                  <i class="lnr lnr-chart-bars"></i>
                  <span data-feather="file-text"></span>
                  Chart Report
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                  <i class="lnr lnr-map"></i>
                  <span data-feather="file-text"></span>
                  All Posts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
                  <i class="lnr lnr-user"></i>
                  <span data-feather="file-text"></span>
                  All Users
                </a>
              </li>
              
            </ul>
        <!-- @endcan -->
        @endif
    </div>
</nav>       