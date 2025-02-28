<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Employee Bonus System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Employee Bonus System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ route(Auth::user()->usertype === 'admin' ? 'admin.dashboard' : 'employee.dashboard') }}">
            Dashboard
        </a>
    </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('employees.index') }}">Manage Employees</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('bonuses.index') }}">Manage Bonuses</a>
        </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endauth

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
