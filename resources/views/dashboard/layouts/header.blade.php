<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
	<i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<!-- <form
	class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
	<div class="input-group">
		<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
			aria-label="Search" aria-describedby="basic-addon2">
		<div class="input-group-append">
			<button class="btn btn-danger" type="button">
				<i class="fas fa-search fa-sm"></i>
			</button>
		</div>
	</div>
</form> -->

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

	<!-- Nav Item - Search Dropdown (Visible Only XS) -->
	

	<div class="topbar-divider d-none d-sm-block"></div>

	<!-- Nav Item - User Information -->
	<li class="nav-item dropdown no-arrow">
		<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="mr-2 d-none d-lg-inline text-gray-600 large">{{ auth()->user()->name }}</span>
			@if(auth()->user()->photo_profil)
			<!-- <img src="{{ asset('storage/'.auth()->user()->photo_profil) }}"alt="mdo" width="32" height="32" class="rounded-circle" > -->
			<img class="img-profile rounded-circle"src="{{ asset('storage/'.auth()->user()->photo_profil) }}">
			@else
			<img class="img-profile rounded-circle"src="/img/photo_profil.png"> 
			@endif
		</a>
		<!-- Dropdown - User Information -->
		<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
			aria-labelledby="userDropdown">
			<a class="dropdown-item" href="/dashboard/myuser/{{auth()->user()->id}}/edit">
				<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i><span data-feather="edit">
				Edit Profile
			</a>
			
			
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
				<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				Logout
			</a>
			
		</div>
	</li>

</ul>

</nav>
<!-- End of Topbar -->

<!-- <header class="navbar navbar-dark sticky-top bg-danger flex-md-nowrap p-0 shadow">
	<div class="col-md-2 text-center" id="ho_main_content"></div>
	
	<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		<a href=""></a>
	</button>
	<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
	<div class="mx-4 text-center" id="ho_main_content"></div>

	

	<div class="mx-4 text-center" id="ho_main_content"></div>
	<div class="dropdown show ">
		<a class="dropleft d-block link-light text-decoration-none dropdown-toggle" href="#" role="button" id="dropdownUser2"  data-bs-toggle="dropdown" aria-expanded="false">
			{{ auth()->user()->name }}
		</a>
		<ul class="dropdown-menu" aria-labelledby="dropdownUser2">
            <li>
				<form action="/logout" method="post">
				@csrf
				<button type="submit" class="dropdown-item" >Logout<span data-feather="logout"></span></button>
				</form>
			</li>
          </ul>
	</div>
	<div class="mx-3 text-center" id="ho_main_content">
		
		@if(auth()->user()->photo_profil)
			<img src="{{ asset('storage/'.auth()->user()->photo_profil) }}"alt="mdo" width="32" height="32" class="rounded-circle" >
		@else
			<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="mdo" width="32" height="32" class="rounded-circle">  
		@endif
	</div>
	

	<div class="mx-5 text-center" id="ho_main_content"></div>

</header> -->


