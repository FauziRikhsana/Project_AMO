<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - MEDALI</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            color: #1f2937;
        }

        /* =========================
           LAYOUT
        ========================= */

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            background: #172554;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 20px 15px;
        }

        .logo {
            padding: 10px 12px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            margin-bottom: 20px;
        }

        .logo h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .logo span {
            font-size: 12px;
            color: #bfdbfe;
        }

        .menu-title {
            font-size: 11px;
            color: #93c5fd;
            text-transform: uppercase;
            margin: 20px 12px 8px;
            letter-spacing: 1px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 5px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #dbeafe;
            padding: 11px 12px;
            border-radius: 7px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .logout-container {
            position: absolute;
            left: 15px;
            right: 15px;
            bottom: 20px;
        }

        .logout-button {
            width: 100%;
            border: none;
            background: #991b1b;
            color: white;
            padding: 11px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-button:hover {
            background: #b91c1c;
        }

        /* =========================
           MAIN
        ========================= */

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .navbar-title {
            font-size: 18px;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .user-detail {
            text-align: right;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
        }

        .user-role {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* =========================
           PAGE CONTENT
        ========================= */

        .content {
            padding: 30px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 14px;
        }

        /* =========================
           STATISTIC CARDS
        ========================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 22px;
            border: 1px solid #e5e7eb;
        }

        .stat-card .label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 28px;
            font-weight: bold;
            color: #111827;
        }

        /* =========================
           CONTENT CARD
        ========================= */

        .card {
            background: white;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: 25px;
            margin-bottom: 20px;
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .card p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 210px;
            }

            .main-content {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 15px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="app-container">

    {{-- =========================
         SIDEBAR
    ========================== --}}
    <aside class="sidebar">

        <div class="logo">
            <h2>MEDALI</h2>
            <span>Maintenance Engineering<br>Database Application</span>
        </div>

        <div class="menu-title">
            Main Menu
        </div>

        <ul class="menu">

            {{-- Dashboard User --}}
            @if(auth()->user()->role === 'user')
                <li>
                    <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>
            @endif

            {{-- Dashboard Admin --}}
            @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>
            @endif

            {{-- Dashboard Super Admin --}}
            @if(auth()->user()->role === 'super_admin')
                <li>
                    <a href="{{ route('superadmin.dashboard') }}">
                        Super Admin Dashboard
                    </a>
                </li>
            @endif

        </ul>


        {{-- =========================
             AMO MENU
        ========================== --}}

        <div class="menu-title">
            AMO
        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('amo.forms.index') }}" class="{{ request()->routeIs('amo.forms.*') ? 'active' : '' }}">
                    Forms
                </a>
            </li>

           @if (auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
    <a href="{{ route('admin.reports.index') }}" class="sidebar-link">
        Reports
    </a>
@else
    <a href="{{ route('amo.reports.index') }}" class="sidebar-link">
        Reports
    </a>
@endif

        </ul>


        {{-- =========================
             ADMIN MENU
        ========================== --}}

        @if(in_array(auth()->user()->role, ['admin', 'super_admin']))

            <div class="menu-title">
                Management
            </div>

            <ul class="menu">

                <li>
                    <a href="{{ route('admin.templates.index') }}" class="{{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                        Template Management
                    </a>
                </li>

            </ul>

        @endif


        {{-- =========================
             SUPER ADMIN MENU
        ========================== --}}

        @if(auth()->user()->role === 'super_admin')

            <div class="menu-title">
                Administration
            </div>

            <ul class="menu">

                <li>
                    <a href="#">
                        User Management
                    </a>
                </li>

            </ul>

        @endif


        {{-- =========================
             LOGOUT
        ========================== --}}

        <div class="logout-container">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>

        </div>

    </aside>


    {{-- =========================
         MAIN CONTENT
    ========================== --}}

    <main class="main-content">

        {{-- Navbar --}}
        <nav class="navbar">

            <div class="navbar-title">
                @yield('title', 'Dashboard')
            </div>

            <div class="user-info">

                <div class="user-detail">

                    <div class="user-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="user-role">
                        {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                    </div>

                </div>

                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            </div>

        </nav>


        {{-- Page Content --}}
        <section class="content">

            @yield('content')

        </section>

    </main>

</div>

</body>
</html>
