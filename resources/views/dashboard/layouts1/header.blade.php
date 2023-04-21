<header class="navbar navbar-dark sticky-top bg-danger flex-md-nowrap p-0 shadow">
	<div class="col-md-2 text-center" id="ho_main_content"></div>
	<!-- <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/dashboard">Main Account</a> -->
	
	<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		<a href=""></a>
	</button>
	<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
	<div class="mx-4 text-center" id="ho_main_content"></div>

	<!-- <div class="dropdown nav navbar-center">
		<a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
		<i class="lnr lnr-home"></i>
		</a>
		<ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
		<li><a href="#" class="dropdown-item"> <span class="dot bg-warning"></span>System space is almost full</a></li>
		<li><a class="dropdown-item" href="#">Settings</a></li>
		<li><a class="dropdown-item" href="#">Profile</a></li>
		<li><hr class="dropdown-divider"></li>
		<li><a class="dropdown-item" href="#">Sign out</a></li>
		</ul>
	</div> -->

	<!-- <div class="nav  navbar-right">
		<li class="dropdown">
			
			<a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="lnr lnr-alarm"></i>
				
			</a>
			<ul class="dropdown-menu dropdown-menu-lg-end">
				<li><a href="#" class="dropdown-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
				<li><a href="#" class="dropdown-item"><span class="dot bg-danger"></span> You have 9 unfinished tasks</a></li>
				<li><a href="#" class="dropdown-item"><span class="dot bg-success"></span> Monthly report is available</a></li>
				<li><a href="#" class="dropdown-item"><span class="dot bg-warning"></span> Weekly meeting in 1 hour</a></li>
				<li><a href="#" class="dropdown-item"><span class="dot bg-success"></span> Your request has been approved</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a href="#" class="dropdown-item"></span>See all notifications</a></li>
			</ul>
		</li>
		
	</div> -->

	<div class="mx-4 text-center" id="ho_main_content"></div>
	<div class="dropdown show ">
		<a class="dropleft d-block link-light text-decoration-none dropdown-toggle" href="#" role="button" id="dropdownUser2"  data-bs-toggle="dropdown" aria-expanded="false">
			{{ auth()->user()->name }}
		</a>
		<ul class="dropdown-menu" aria-labelledby="dropdownUser2">
            <!-- <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><hr class="dropdown-divider"></li> -->
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
			<!-- <img href="/storage/app/public/user-images/no-profil.png"alt="mdo" width="32" height="32" class="rounded-circle" > -->
			<img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="mdo" width="32" height="32" class="rounded-circle">  
		@endif
	</div>
	

	<div class="mx-5 text-center" id="ho_main_content"></div>

</header>


