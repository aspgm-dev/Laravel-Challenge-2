<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./index.html" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v3</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link {{ Request::path() == 'home' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}"
                    class="nav-link {{ Request::path() == 'category' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Category
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tag.index') }}"
                    class="nav-link {{ Request::path() == 'tag' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>
                        Tag
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.news.index') }}" class="nav-link {{ Request::path() == 'news' ? 'active' : '' }}
                        {{ Request::path() == 'news/create' ? 'active' : '' }}
                        {{ request()->is('news/*/edit') ? 'active' : '' }}
                        {{ request()->is('news/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        News
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.comment.index') }}"
                    class="nav-link {{ Request::path() == 'comment' ? 'active' : '' }}
                        {{ Request::path() == 'comment/create' ? 'active' : '' }}
                        {{ request()->is('comment/*/edit') ? 'active' : '' }}
                        {{ request()->is('comment/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                        Comment
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>