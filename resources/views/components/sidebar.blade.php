<div class="sidebar bg-white p-2 h-100 d-none d-sm-inline" style="width: 300px;">
    <div class="mt-2 w-100 h-25 d-flex flex-column justify-content-center align-items-center">
        <h1><code>WBEOBC</code></h1>
        <div class="w-100 d-flex justify-content-center align-items-center p-2">
            <span class="badge text-bg-primary">{{ auth()->user()->name }}</span>
        </div>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item py-1">
            <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'profile') ? 'bg-primary text-white rounded' : '' }}" href="{{ route('profile.index') }}">
                <i class="bi bi-person-fill p-2"></i>
                Manage Profile
            </a>
        </li>

        @if(Auth::check() && Auth::user()->role_id == 1)
            <li class="nav-item py-1">
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'users') ? 'bg-primary text-white rounded' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-people-fill p-2"></i>
                    Users
                </a>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'clearance') ? 'bg-primary text-white rounded' : '' }}" href="{{route('clearance.index')}}">
                    <i class="bi bi-file-earmark-fill p-2"></i>
                    Manage Clearance
                </a>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'hr_questionnaire') ? 'bg-primary text-white rounded' : '' }}" href="{{ route('hr_questionnaire.index')}}">
                    <i class="bi bi-question-circle-fill p-2"></i>
                    Questionnaire
                </a>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link" href="{{route('request.coe')}}">
                    <i class="bi bi-award-fill p-2"></i>
                    Generate COE
                    @if($count_completed_requests > 0)
                        <span class="badge bg-success ms-2">{{ $count_completed_requests }}</span>
                    @endif
                </a>
            </li>
        @endif

        @if(Auth::check() && Auth::user()->role_id == 2)
            <li class="nav-item py-1">
                <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'official_requests') ? 'bg-primary text-white rounded' : '' }}" href="{{ route('official_requests.index') }}">
                    <i class="bi bi-file-earmark-fill p-2"></i>
                    Request Clearance
                </a>
            </li>
        @endif

        @if(Auth::check() && Auth::user()->role_id == 3)
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
                    @if($coe_available > 0)
                        <span class="badge bg-success ms-2">{{ $coe_available }}</span>
                    @endif
                </a>
            </li>
        @endif

        <li class="nav-item py-1">
            <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'change_password') ? 'bg-primary text-white rounded' : '' }}" href="{{route('change_password')}}" onclick="">         
                <i class="bi bi-key-fill p-2"></i>
                Change password
            </a>
        </li>

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