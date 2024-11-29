<div class="sidebar bg-white p-2 h-100 d-none d-sm-inline" style="width: 300px;">
    <div class="mt-2 border border-danger w-100 h-25">
        LOGO HERE
    </div>
    <ul class="nav flex-column">
        <!-- For Clearing officer -->
        <li class="nav-item py-1">
            <a class="nav-link bg-light rounded" href="#">
                <i class="bi bi-file-earmark-fill p-2"></i>
                Request Clearance
            </a>
        </li>
        <!-- For Clearing officer -->

        <!-- For employee -->
        <li class="nav-item py-1">
            <a class="nav-link bg-light rounded" href="#">
                <i class="bi bi-person-fill p-2"></i>
                Manage Profile
            </a>
        </li>

        <li class="nav-item py-1">
            <a class="nav-link bg-light rounded" href="#">
                <i class="bi bi-file-earmark-fill p-2"></i>
                Request Clearance
            </a>
        </li>
        <!-- For employee -->
        <li class="nav-item py-1">
            <a class="nav-link text-danger" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">         
                <i class="bi bi-door-closed fs-5 p-2"></i> 
                Logout
            </a>
            <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
            </form>        
        </li>
    </ul>
</div>