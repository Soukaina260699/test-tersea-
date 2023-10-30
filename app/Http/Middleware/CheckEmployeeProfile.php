<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmployeeProfile
{
    public function handle($request, Closure $next)
    {
        $employee = $request->user();

        if ($employee->verified) {
            return $next($request);
        }
        if (auth()->user() && auth()->user()->verified) {
            return $next($request);
        }

        return redirect()->route('employee.complete_profile_form')
            ->with('warning', 'Veuillez compléter votre profil avant d\'accéder à votre espace privé.');
    }
}
