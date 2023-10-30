<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Models\Employe;

class AuditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $adminId = auth()->user()->id;
        $action = 'Envoi d’invitation';
        $employeId = $request->route('employeId');
        $employe = Employe::find($employeId);
        $message = "Admin";

        if (auth()->check()) {
            $message .= ' “' . auth()->user()->name . '”';
        } else {
            $message .= ' inconnu';
        }
        
    
        AuditLog::create([
            'action' => $action,
            'admin_id' => $adminId,
            'employee_id' => $employeId,
            'message' => $message,
        ]);
    
        return $next($request);
    }
}
