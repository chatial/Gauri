<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/admin">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin-product">
            <span data-feather="folder-plus" class="align-text-bottom"></span>
            Product
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin-wedding">
            <span data-feather="folder-plus" class="align-text-bottom"></span>
            Wedding
            </a>
        </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <form action="/logout" method="post">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link px-3">
                        <span data-feather="log-out" class="align-text-bottom"></span> Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>
    </nav>