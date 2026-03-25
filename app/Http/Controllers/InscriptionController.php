<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class InscriptionController extends Controller
{
    // Un adhérent s'inscrit à une compétition
    #[Post('/competitions/{id}/inscrire', middleware: 'auth.adherent:0')]
    public function inscrire($id)
    {
        $adherent = session('adherent');
        $competition = Competition::findOrFail($id);

        // Vérifier si déjà inscrit
        $existing = Inscription::where('ADH_ID', $adherent->ADH_ID)
            ->where('COM_ID', $competition->COM_ID)
            ->first();

        if ($existing) {
            return back()->with('error', 'Vous êtes déjà inscrit à cette compétition.');
        }

        Inscription::create([
            'ADH_ID' => $adherent->ADH_ID,
            'COM_ID' => $competition->COM_ID,
            'INS_DATE' => now()->toDateString(),
            'INS_ETAT' => 0, // en attente
        ]);

        return back()->with('success', 'Demande d\'inscription envoyée avec succès.');
    }

    // Un entraîneur consulte les inscriptions d'une compétition
    #[Get('/competitions/{id}/inscriptions', middleware: 'auth.adherent:1')]
    public function inscriptions($id)
    {
        $competition = Competition::findOrFail($id);
        $inscriptions = Inscription::with('adherent')
            ->where('COM_ID', $id)
            ->get();

        return view('inscriptions.list', compact('competition', 'inscriptions'));
    }

    // Accepter une inscription
    #[Post('/inscriptions/{id}/accepter', middleware: 'auth.adherent:1')]
    public function accepter($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->INS_ETAT = 1;
        $inscription->save();

        return back()->with('success', 'Inscription acceptée.');
    }

    // Refuser une inscription
    #[Post('/inscriptions/{id}/refuser', middleware: 'auth.adherent:1')]
    public function refuser($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->INS_ETAT = 2;
        $inscription->save();

        return back()->with('success', 'Inscription refusée.');
    }

    // Un adhérent consulte ses propres inscriptions
    #[Get('/mes-inscriptions', middleware: 'auth.adherent:0')]
    public function mesInscriptions()
    {
        $adherent = session('adherent');
        $inscriptions = Inscription::with('competition.club', 'competition.discipline')
            ->where('ADH_ID', $adherent->ADH_ID)
            ->get();

        return view('inscriptions.mes_inscriptions', compact('inscriptions'));
    }

    // Un entraîneur consulte les participants validés d'une compétition
    #[Get('/competitions/{id}/participants', middleware: 'auth.adherent:1')]
    public function participants($id)
    {
        $competition = Competition::findOrFail($id);
        $participants = Inscription::with('adherent')
            ->where('COM_ID', $id)
            ->where('INS_ETAT', 1)
            ->get();

        return view('inscriptions.participants', compact('competition', 'participants'));
    }
}
