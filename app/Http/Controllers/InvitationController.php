<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Mail\InviteEmployee;
use App\Models\Employe;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function create(){
        $societes = Societe::all(); // Récupérez la liste des sociétés depuis la base de données
        return view('invitations.create', compact('societes'));
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:invitations',
            'societe_id' => 'required',
        ]);

        $token = Str::random(32);

        $invitation = Invitation::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'societe_id' => $request->input('societe_id'),
            'token' => $token,
        ]);

        // Envoi de l'e-mail d'invitation
        Mail::to($request->input('email'))->send(new InviteEmployee($invitation));

        return redirect()->route('invitations.index')
            ->with('success', 'Invitation envoyée avec succès.');
    }


    public function index(){
        $invitations = Invitation::all();
        return view('invitations.index', compact('invitations'));
    }

    public function destroy($id){
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();

        return redirect()->route('invitations.index')
            ->with('success', 'Annulation avec succès');
    }

    public function accept($token) {
        $invitation = Invitation::where('token', $token)->first();
        if (!$invitation) {
            redirect('/');
        }

        $employe = new Employe();
        $employe->email = $invitation->email;

        return view('accept', compact('employe'));
    }


}
