<div class="sidebar bg-white p-2 h-100 d-none d-sm-inline" style="width: 300px;">
    <div class="mt-2 border border-danger w-100 h-25">
        LOGO HERE
    </div>
    <ul class="nav flex-column">
        <!-- For HR -->

        @if(Auth::check() && Auth::user()->role_id == 1)
            <li class="nav-item py-1">
                <a class="nav-link bg-primary text-white rounded" href="{{ route('users.index') }}">
                    <i class="bi bi-people-fill p-2"></i>
                    Users
                </a>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link bg-light rounded" href="{{route('clearance.index')}}">
                    <i class="bi bi-file-earmark-fill p-2"></i>
                    Manage Clearance
                </a>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link bg-light rounded" href="#">
                    <i class="bi bi-question-circle-fill p-2"></i>
                    Questionnaire
                </a>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link bg-light rounded" href="#">
                    <i class="bi bi-award-fill p-2"></i>
                    Generate COE
                </a>
            </li>
        @endif
        <!-- For HR -->
        
        <!-- For Clearing officer -->
        @if(Auth::check() && Auth::user()->role_id == 2)
            <li class="nav-item py-1">
                <a class="nav-link bg-light rounded" href="#">
                    <i class="bi bi-file-earmark-fill p-2"></i>
                    Request Clearance
                </a>
            </li>
        @endif
        <!-- For Clearing officer -->

        <!-- For employee -->
        @if(Auth::check() && Auth::user()->role_id == 3)
            <li class="nav-item py-1">
            <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'profile') ? 'bg-primary text-white rounded' : '' }}" href="{{ route('profile.index') }}">
                <i class="bi bi-person-fill p-2"></i>
                Manage Profile
            </a>
            </li>

            <li class="nav-item py-1">
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'employee_clearance') ? 'bg-primary text-white rounded' : '' }}" href="{{ route('employee_clearance.index') }}">
                    <i class="bi bi-file-earmark-fill p-2"></i>
                    Request Clearance
                </a>
            </li>

            <li class="nav-item py-1">
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'employee_coe') ? 'bg-primary text-white rounded' : '' }}" href="{{ route('employee_coe.index') }}">
                    <i class="bi bi-award-fill p-2"></i>
                    COE
                </a>
            </li>
        @endif
        <!-- For employee -->

        <li class="nav-item py-1">
            <a class="nav-link text-danger" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">         
                <i class="bi bi-door-closed fs-5 p-2"></i> 
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>        
        </li>
    </ul>
</div>