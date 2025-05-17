<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/akku-logo.png') }}" type="image/png" sizes="16x16">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Multi Select Tag CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">

    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #343a40;
            padding: 20px;
            color: white;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.text-white {
            color: white;
            background-color: #495057;
            border-radius: 8px;
        }

        .content {
            margin-left: 270px;
            padding: 30px;
        }
    </style>
</head>

<body style="background-color: rgba(250, 250, 250, 0.95);">
    @php use App\Models\UserManagement; @endphp

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="mb-4 text-center">
            <img src="{{ asset('assets/images/akku-logo.png') }}" alt="Logo" width="150" height="100"
                class="mb-2">
            <h4 class="fw-bold">PT AKKU</h4>
        </div>

        <div class="user-info d-flex align-items-center mb-4">
            <i class="bi bi-person-circle fs-3 me-2"></i>
            <div>
                <p class="mb-0">{{ Auth::user()->userRole->role ?? 'Belum Terdaftar' }}</p>
                <p class="mb-0 fw-bold">{{ Auth::user()->name }}</p>
            </div>
        </div>

        <ul class="nav flex-column g-3">
            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 1)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard/leader') ? 'text-white' : '' }}"
                        href="{{ route('dashboardLeader') }}">Dashboard Leader</a>
                </li>
            @endif

            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 2)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard/admin') ? 'text-white' : '' }}"
                        href="{{ route('dashboardadmin') }}">Dashboard Admin</a>
                </li>
            @endif

            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 3)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard/admin') ? 'text-white' : '' }}"
                        href="{{ route('dashboardadmin') }}">Dashboard Manager</a>
                </li>
            @endif

            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 8)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('operator-production') ? 'text-white' : '' }}"
                        href="{{ route('operator-production') }}">Operator Produksi</a>
                </li>
            @endif


            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 4)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() === 'report_approval' ? 'text-white' : '' }}"
                        href="{{ route('report_approval') }}">Laporan Harian</a>
                </li>
            @endif

            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 5)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('production') ? 'text-white' : '' }}"
                        href="{{ route('production.index') }}">Laporan Produksi</a>
                </li>
            @endif

            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 6)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('production-monthly') ? 'text-white' : '' }}"
                        href="{{ route('reportMonthly') }}">Laporan Bulanan</a>
                </li>
            @endif

            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 7)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('monitoringGroup') ? 'text-white' : '' }}"
                        href="{{ route('monitoringGroup') }}">Monitoring Group</a>
                </li>
            @endif

            @if (UserManagement::where('role_id', auth()->user()->role_id)->where('menu_id', 12)->exists())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('userManagement') ? 'text-white' : '' }}"
                        href="{{ route('userSettings') }}">User Management</a>
                </li>
            @endif

            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content" style="background-color: rgba(250, 250, 250, 0.95);">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    @yield('scripts')

</body>

</html>
