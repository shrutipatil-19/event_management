<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand w-100 h-100">
            <img src="{{ asset('frontend-assets/img/logo/sc-colored-horizontal.png') }}" alt="" class="w-100 h-100" style="object-fit: contain;">
        </a>
        <div class="sidebar-toggler">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav" id="sidebarNav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Events</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Events</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" data-bs-parent="#sidebarNav" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('listEvent') }}" class="nav-link">List Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('createEvent') }}" class="nav-link">Add Events</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Category</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" data-bs-parent="#sidebarNav" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('createCat') }}" class="nav-link">Add Category</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listCat') }}" class="nav-link">List Category</a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->