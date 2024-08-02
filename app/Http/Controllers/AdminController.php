<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dossier;
use App\Models\Document;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function manageUsers()
    {
        $users = User::all();

        return response()->json(['users' => $users], 200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'sometimes|string|in:client,partenaire,admin',
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    public function manageDocuments()
    {
        $documents = Document::all();

        return response()->json(['documents' => $documents], 200);
    }

    public function approveDocument($id)
    {
        $document = Document::findOrFail($id);
        $document->update(['status' => 'approved']);

        return response()->json(['message' => 'Document approved successfully'], 200);
    }

    public function rejectDocument($id)
    {
        $document = Document::findOrFail($id);
        $document->update(['status' => 'rejected']);

        return response()->json(['message' => 'Document rejected successfully'], 200);
    }

    public function manageDossiers()
    {
        $dossiers = Dossier::all();

        return response()->json(['dossiers' => $dossiers], 200);
    }

    public function updateDossierStatus(Request $request, $id)
    {
        $dossier = Dossier::findOrFail($id);
        $request->validate([
            'status' => 'required|string|in:in progress,completed,cancelled',
        ]);

        $dossier->update(['status' => $request->status]);

        return response()->json(['message' => 'Dossier status updated successfully', 'dossier' => $dossier], 200);
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'type' => 'notification',
        ]);

        return response()->json(['message' => 'Notification sent successfully', 'notification' => $notification], 201);
    }

    public function viewStatistics()
    {
        // Logique pour récupérer les statistiques globales de l'application
        $statistics = [
            'total_users' => User::count(),
            'total_dossiers' => Dossier::count(),
            'total_documents' => Document::count(),
            // Ajouter d'autres statistiques nécessaires
        ];

        return response()->json(['statistics' => $statistics], 200);
    }

}
