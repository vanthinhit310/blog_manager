<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="../../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    @permission('list-role')
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-permission" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="ni ni-ungroup text-orange"></i>
                            <span class="nav-link-text">Permissions</span>
                        </a>
                        <div class="collapse" id="navbar-permission">
                            <ul class="nav nav-sm flex-column">
                                @permission('list-role')
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link">Role</a>
                                </li>
                                @endpermission
                                @permission('list-ability')
                                <li class="nav-item">
                                    <a href="{{ route('admin.ability.index') }}" class="nav-link">Ability</a>
                                </li>
                                @endpermission
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('list-user')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user.index') }}">
                            <i class="ni ni-archive-2 text-orange"></i>
                            <span class="nav-link-text">User</span>
                        </a>
                    </li>
                    @endpermission
                </ul>
            </div>
        </div>
    </div>
</nav>
