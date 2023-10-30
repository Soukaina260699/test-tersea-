<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;



class HistoriqueController extends Controller
{
    public function index(){
        $auditLogs = AuditLog::orderBy('created_at', 'desc')->get();
        return view('historique', compact('auditLogs'));
    }

}
