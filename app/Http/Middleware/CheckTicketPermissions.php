<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTicketPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        $user = Auth::user();

        if ($permission == 'create') {
            // Chỉ cho phép Regular User và Admin tạo ticket
            if ($user->hasRole('Admin') || $user->hasRole('Regular User')) {
                return $next($request);
            }
        } elseif ($permission == 'edit') {
            // Chỉ cho phép Admin và Agent sửa ticket
            if ($user->hasRole('Admin') || $user->hasRole('Agent')) {
                return $next($request);
            }
        }

        // Nếu không có quyền, redirect về trang home hoặc thông báo lỗi
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}
