<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="{{ route('admin') }}"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                    </li>
                    <li class="nav-divider">
                        Manage Music
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-music" aria-controls="submenu-music"><i class="las la-music"></i> Musics </a>
                        <div id="submenu-music" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('musics.all') }}">All Musics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('musics.add') }}">Add Music</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('playlists.all') }}">Playlist</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('genres.all') }}">Genres</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('artists.all') }}">Artists</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('albums.all') }}">Albums</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-divider">
                        Manage Newsletter
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('newsletter') }}"><i class="las la-file-alt"></i> Send Weekly Newsletter</a>
                    </li>
                    </li>
                    <li class="nav-divider">
                        Manage Website
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.contact') }}"><i class="las la-file-alt"></i> View Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-slider" aria-controls="submenu-slider"><i class="las la-sliders-h"></i> Sliders </a>
                        <div id="submenu-slider" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sliders') }}">All Sliders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sliders.add') }}"></i>Add Slider</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-user" aria-controls="submenu-user"><i class="las la-sliders-h"></i> Users </a>
                        <div id="submenu-user" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users') }}">All Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.admin') }}">All Admins</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.admin.add') }}"></i>Add Admin</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('content.one') }}"><i class="las la-file-alt"></i> Content Section One</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('content.two') }}"><i class="las la-file-alt"></i> Content Section Two</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('settings') }}"><i class="las la-cog"></i> Settings</a>
                        <a class="nav-link" href="{{ route('settings.payment') }}"><i class="las la-cog"></i> Payment Settings</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>