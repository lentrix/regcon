<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('images/branding.png')}}" style="height:80px" alt="PSITE-7">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/about')}}">
                        <i class="fa fa-question"></i> About
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/contact-us')}}">
                        <i class="fa fa-phone-square"></i> Contact Us
                    </a>
                </li>

                @auth
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/participants')}}">
                        <i class="fa fa-users"></i> Participants
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/raffle')}}">
                        <i class="fa fa-pie-chart"></i> Raffle
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/elections')}}">
                        <i class="fa fa-hand-o-up"></i> Election
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/logout')}}" style="color: rgb(255, 182, 251)">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
