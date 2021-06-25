<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::select('id', 'code_cne', 'code_cin')
        ->get();

        foreach($etudiants as $etudiant) {
            $user = new User();
            $user->email = "$etudiant->code_cne@estsb.ma";
            $user->password = Hash::make("$etudiant->code_cin@$etudiant->code_cne");
            $user->etudiant_id = $etudiant->id;
            $user->save();
        }

        return "users ajouté";
    }

}
