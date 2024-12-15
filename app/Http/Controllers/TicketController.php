<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Administrator')) {
            // Admin xem tất cả tickets
            $tickets = Ticket::latest()->paginate(10);
        } elseif ($user->hasRole('Agent')) {
            // Agent xem các ticket được assign cho họ
            $tickets = Ticket::where('assigned_user_agent_id', $user->id)
                ->with('assignedUser')
                ->latest()
                ->paginate(10);
        } else {
            // Regular User chỉ xem các ticket do họ tạo
            $tickets = Ticket::where('created_by', $user->id)
                ->latest()
                ->paginate(10);
        }

        return view('tickets.index', compact('tickets'));
    }

    // Hiển thị form tạo mới ticket
    public function create()
    {
        return view('tickets.create');
    }

    // Lưu ticket mới
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|in:low,medium,high,critical',
        ]);

        Ticket::create([
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'status'      => 'in_progress',
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    // Hiển thị form chỉnh sửa ticket
    public function edit(Ticket $ticket)
    {
        // Quyền: Admin hoặc Agent (được assign) mới được sửa
        if (Auth::user()->hasRole('Administrator') ||
            (Auth::user()->hasRole('Agent') && Auth::id() === $ticket->assigned_user_agent_id)) {
            return view('tickets.edit', compact('ticket'));
        }

        abort(403, 'Unauthorized action.');
    }

    // Cập nhật ticket
    public function update(Request $request, Ticket $ticket)
    {
        // Admin hoặc Agent (được assign) mới được phép cập nhật
        $user = Auth::user();

        if (!$user->hasRole('Administrator') && $user->id !== $ticket->assigned_user_agent_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|in:low,medium,high,critical',
            'status'      => 'required|in:open,in_progress,closed',
        ]);

        $ticket->update($request->only(['title', 'description', 'priority', 'status']));

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    // Xóa ticket (chỉ Admin)
    public function destroy(Ticket $ticket)
    {
        if (Auth::user()->hasRole('Administrator')) {
            $ticket->delete();
            return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
        }

        abort(403, 'Unauthorized action.');
    }

    // Thay đổi trạng thái ticket (chỉ Admin)
    public function changeStatus(Request $request, Ticket $ticket)
    {
        if (Auth::user()->hasRole('Administrator')) {
            $request->validate([
                'status' => 'required|in:open,in_progress,closed',
            ]);

            $ticket->update(['status' => $request->status]);
            return redirect()->route('tickets.index')->with('success', 'Status updated successfully.');
        }

        abort(403, 'Unauthorized action.');
    }

    // Assign ticket cho Agent (chỉ Admin)
    public function assignAgent(Request $request, Ticket $ticket)
    {
        if (Auth::user()->hasRole('Administrator')) {
            $request->validate([
                'assigned_user_agent_id' => 'required|exists:users,id',
            ]);

            $ticket->update(['assigned_user_agent_id' => $request->assigned_user_agent_id]);

            return redirect()->route('tickets.index')->with('success', 'Ticket assigned to agent.');
        }

        abort(403, 'Unauthorized action.');
    }
}
