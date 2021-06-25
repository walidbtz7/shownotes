@extends('layouts.master')

@section('content')
    <div class="container my-5 py-3">
        <App nom="{{ auth()->user()->etudiant->prenom }}"></App>
    </div>
@endsection