<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminController extends Controller{

    public function dashboard(){
        return view('admin.dashboard'); 
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
        ]);

        Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Administrateur créé avec succès');
    }


    public function index(){
        return view('admin.index');
    }

    public function getData(){
        $admins = Admin::select(['name', 'email'])->get();

        return Datatables::of($admins)
            ->addColumn('action', function ($admin) {
                return '<button class="btn btn-primary">Éditer</button> <button class="btn btn-danger">Supprimer</button>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    

    

}
