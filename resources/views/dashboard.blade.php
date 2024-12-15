@extends('layouts.app')

@section('content')
    <h2>Dashboard - {{ $role }}</h2>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tickets.index') }}">
                                <i class="bi bi-ticket"></i> Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-journal-text"></i> Ticket Logs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-archive"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-tag"></i> Labels
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Dashboard</h2>
                <div class="card mt-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-ticket-fill text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <div>
                            <h5>Total tickets</h5>
                            <h3>3</h3>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
