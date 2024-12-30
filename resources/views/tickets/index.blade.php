@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ticket List</h1>

        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>

        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Regular User'))
            <a href="{{ route('tickets.create') }}" class="btn btn-success mb-3">Create New Ticket</a>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Assigned Agent</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ ucfirst($ticket->priority) }}</td>
                    <td>
                        @if(Auth::user()->hasRole('Admin'))
                            <form method="POST" action="{{ route('tickets.status.update', $ticket->id) }}">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="form-select">
                                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </form>
                        @else
                            {{ ucfirst($ticket->status) }}
                        @endif
                    </td>
                    <td>{{ $ticket->assigned_user_agent_id ?? 'Unassigned' }}</td>
                    <td>
                        @if(Auth::user()->hasRole('Admin'))
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @elseif(Auth::user()->hasRole('Agent'))
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        @else
                            <span class="text-muted">No Actions</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No tickets available.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $tickets->links() }}
    </div>
@endsection
