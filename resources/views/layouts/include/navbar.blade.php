<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ url('/index') }}" role="button">
                            <i class="bx bx-home-circle me-2"></i><span
                                key="t-starter-page">@lang('translation.Starter_Page')</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none active" href="{{ url('/layouts-horizontal') }}" role="button">
                            <i class="bx bx-layout me-2"></i><span key="t-horizontal">Horizontal</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                            <i class="bx bx-user-circle me-2"></i><span key="t-authentication">Authentication</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-auth">
                            <a href="#" class="dropdown-item" key="t-login">Menu 1</a>
                            <a href="#" class="dropdown-item" key="t-login-2">Menu 2</a>
                            <a href="#" class="dropdown-item"
                                key="t-register">Menu 3</a>
                            
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>