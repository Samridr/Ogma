<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DossierController extends Controller
{
    //
    public function createDossier(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255|unique:dossiers',
        ]);

        $dossier = Dossier::create([
            'user_id' => Auth::id(),
            'reference' => $request->reference,
            'status' => 'in progress',
        ]);

        return response()->json(['message' => 'Dossier created successfully', 'dossier' => $dossier], 201);
    }

    public function viewDossier($id)
    {
        $dossier = Dossier::findOrFail($id);

        if ($dossier->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['dossier' => $dossier], 200);
    }

    public function trackProgress($id)
    {
        $dossier = Dossier::findOrFail($id);

        if ($dossier->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $misesAJour = $dossier->misesAJour;

        return response()->json(['progress' => $misesAJour], 200);
    }

    public function updateDossierStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:in progress,completed,cancelled',
        ]);

        $dossier = Dossier::findOrFail($id);
        $dossier->status = $request->status;
        $dossier->save();

        return response()->json(['message' => 'Dossier status updated successfully', 'dossier' => $dossier], 200);
    }

}
