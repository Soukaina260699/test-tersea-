<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;


class SocieteController extends Controller{
    public function index(){
        $societes = Societe::all();
        return view('societes.index', compact('societes'));
    }

    public function create(){
        return view('societes.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nom' => 'required',
            'adresse' => 'required',
            'capitale' => 'required'
        ]);

        Societe::create([
            'nom' => $request->input('nom'),
            'adresse' => $request->input('adresse'),
            'capitale' => $request->input('capitale')
        ]);

        return redirect()->route('societes.index')
            ->with('success', 'Société créée avec succès');
    }

    public function update(Request $request, $societeId) {
        $this->validate($request, [
            'societe-nom' => 'required',
            'societe-adresse' => 'required',
            'societe-capitale' => 'required',
        ]);
    
        $societe = Societe::findOrFail($societeId);
    
        $societe->nom = $request->input('societe-nom');
        $societe->adresse = $request->input('societe-adresse');
        $societe->capitale = $request->input('societe-capitale');
        $societe->save();
    
        return redirect()->route('societes.index')->with('success', 'Société mise à jour avec succès');
    }
    
    

    public function destroy($id){
        $societe = Societe::findOrFail($id);
    
        if ($societe->employes->isEmpty()) {
            $societe->delete();
            return redirect()->route('societes.index')
                ->with('success', 'Société supprimée avec succès');
        } else {
            return redirect()->route('societes.index')
                ->with('error', 'Vous ne pouvez pas supprimer cette société car elle a des employés.');
        }
    }
    
}
