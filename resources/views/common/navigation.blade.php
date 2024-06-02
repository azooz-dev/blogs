<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-9">
            <nav class="navbar navbar-expand-lg bg-body-tertiary shadow rounded pt-2 p-1" style="background-color: rgb(31 41 55 / 45%);">
				<div class="container-fluid" style="padding-left: 6px;">
					<a href="#" class="navbar-brand" style=" margin-left: 10px; font-weight: 600; text-decoration: none;">
                        <img src="{{ asset('profile-pics/Designer (1).png') }}" style="width: 50px; height: 50px; border-radius: 100%" alt="">
                    </a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"><i class="fa-solid fa-bars" style="color: white; font-size: 20px;"></i></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Porfile</a>
                            </li>
                        </ul>

                @auth
                
                <!-- For Logged In User -->
                <div class="d-flex w-100 justify-content-end align-items-center" id="logout-div">
                    <img id="nav-user-image" class="rounded-circle" style="width: 40px; height: 40px;" src="{{ Storage::url(Auth::user()->profile_image) }}" alt="">
                    <b class="m-1" id="nav-username">@auth(){{ Auth::user()->username }}
                        
                    </b>
                    @endauth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" data-bs-toggle="modal"  class="btn btn-outline-danger mx-2">Logout</button>
                    </form>
                </div>
                <!-- End Logged In User -->
                @else
                <!-- For Non-Logged In User -->
                <div class="d-flex w-100 justify-content-end" id="login-div">
                    {{-- <button id="login-btn" type="button" data-bs-toggle="modal" data-bs-target="#login-modal" class="btn btn-outline-success mx-2"></button> --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-success mx-2">Login</a>
                    {{-- <button id="register-btn" type="button" data-bs-toggle="modal" data-bs-target="#register-modal" class="btn btn-outline-success">Register</button> --}}
                    <a href="{{ route('register') }}" class="btn btn-outline-success">Register</a>
                </div>
                <!-- End Non-Logged In user -->
                @endauth

            </div>
            </div>
        </nav>
        </div>
    </div>
</div>
</div>