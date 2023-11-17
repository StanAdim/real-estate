<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">@if(auth()->check())
                    <!-- Check if the user is authenticated -->
                    <p>{{ auth()->user()->name }}</p>
                    @endif
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (auth()->check() && auth()->user()->user_type == 2)
                <!-- Content for users with user_type 2 (sellers) -->
                <li class="nav-item">
                    <a href="{{ route('seller.add-property') }}" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Properties
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('seller.add-property') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Property</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seller.properties') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Properties</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.add-property') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Add Property
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.messages') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Messages
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                @endif

                @if (auth()->check() && auth()->user()->user_type == 1)
                <li class="nav-item">
                    <a href="{{ route('admin.users-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.properties') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Properties</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>