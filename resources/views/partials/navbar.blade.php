<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('images/psite7_logo_small.png')}}" alt="PSITE-7">
            Convention Manager
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/about')}}">
                        <i class="fa fa-question"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/contact-us')}}">
                        <i class="fa fa-phone-square"></i> Contact Us
                    </a>
                </li>

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa-fa-user"></i> {{auth()->user()->fname}}
                    </a>
                    <div class="dropdown-menu bg-info" aria-labelledby="navbarDropdown">
                        <div style="padding: 10px">
                            Profile Pic
                        </div>
                        <div class="nav-item">
                            <a href="{{url('/logout')}}" class="nav-link">
                                <i class="fa fa-logout"></i> Profile
                            </a>
                        </div>
                        <hr>
                        <div class="nav-item">
                            <a href="{{url('/logout')}}" class="nav-link">
                                <i class="fa fa-logout"></i> Logout
                            </a>
                        </div>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
