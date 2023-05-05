<nav class="navbar navbar-bg-color navbar-expand-lg navbar-bg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Connect Me</a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <div class="p-2 d-flex flex-row">
                @if(auth()->check() == 1)
                    <div class="ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.show',auth()->user()) }}">
                                    {{ auth()->user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn text-white">Logout</button>
                                </form>
                            </li>
                            <li class="nav-item notifications">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                      </div>
                @else
                    <div class="p-3">
                        <a href="{{ route('login') }}" class="mt-2">Login</a>
                        <a href="{{ route('register') }}" class="mt-2 me-5">/Register</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</nav>
