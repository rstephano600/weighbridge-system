<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">My System</a>

        <div class="d-flex">
            <span class="text-white me-3">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 bg-light vh-100 p-3">
            <h5>Menu</h5>
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">Dashboard</a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('truck_visits.index') }}" class="nav-link">Truck Visits</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('weighInputTruck') }}" class="nav-link">Truck Weight Informations</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('trucks.index') }}" class="nav-link">Trucks</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('drivers.index') }}" class="nav-link">drivers</a>
                </li>

                
                <li class="nav-item">
                    <a href="#" class="nav-link">Users</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Reports</a>
                </li>

            </ul>
        </div>

        <!-- Content -->
        <div class="col-md-10 p-4">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>