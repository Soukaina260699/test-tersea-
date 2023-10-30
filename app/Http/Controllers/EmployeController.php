<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use Illuminate\Support\Facades\Hash;


class EmployeController extends Controller
{
    public function completeProfileForm(){
        return view('employee.complete_profile');
    }

    public function completeProfile(Request $request) {
        $request->validate([
            'password' => 'required|min:8',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'birth_date' => 'required|date',
        ]);
    
        $employe = new Employe();
        
        $employe->email = $request->input('email');
        $employe->password = Hash::make($request->input('password'));
        $employe->name = $request->input('name');
        $employe->address = $request->input('address');
        $employe->phone = $request->input('phone');
        $employe->birth_date = $request->input('birth_date');
        
        $employe->verified = true;
    
        $employe->save();
    
        auth()->login($employe);
    
        return redirect()->route('employee.view_profile');
    }
    

    public function viewProfile() {
        $employee = auth()->user(); 
        $societe = $employee->societe;
    
        return view('employee.view_profile', compact('employee', 'societe'));
    }
    

    
}
