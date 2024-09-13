<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    //
    public function createTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return response()->json(['message' => 'Support ticket created successfully', 'ticket' => $ticket], 201);
    }

    public function viewTickets()
    {
        $tickets = Auth::user()->supportTickets;
        return response()->json(['tickets' => $tickets], 200);
    }

    public function replyToTicket($id, Request $request)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $ticket = SupportTicket::findOrFail($id);
        $ticket->update(['response' => $request->response, 'status' => 'pending']);

        // Logique pour notifier l'utilisateur de la réponse

        return response()->json(['message' => 'Response sent successfully', 'ticket' => $ticket], 200);
    }

    public function closeTicket($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $ticket->status = 'closed';
        $ticket->save();

        return response()->json(['message' => 'Support ticket closed', 'ticket' => $ticket], 200);
    }
}
