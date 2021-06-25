<?php

namespace App\Http\Controllers;


use App\Models\Note;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Resources\NoteResource;

class NotesController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    
    public function notes()
    {
        $notes = Note::where('etudiant_id', auth()->user()->etudiant->id)->get();
        return NoteResource::collection($notes)->collection;
    }

    public function pdf()
    {
        $notes = Note::all();
        $notes->transform(function (Note $note) {
            return [
                'id' => $note->id,
                'controle' => $note->controle,
                'exam' => $note->exam,
                'element' => $note->element->nom,
                'module' => $note->element->module->nom,
                'semestre' => $note->element->module->semestre,
            ];
        });
        $semestres = $notes->groupBy('semestre');
        // return view('pdf', compact('semestres'));
        $pdf = PDF::loadView('pdf', compact('semestres'));
        return $pdf->download('releve-de-notes.pdf');
    }
}
