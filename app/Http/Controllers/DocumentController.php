<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    //

    public function index(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('User.index',compact('docs'));
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        $filePath = $request->file('file')->store('documents');

        $document = Document::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Document uploaded successfully', 'document' => $document], 201);
    }

    public function viewDocuments()
    {
        $documents = Auth::user()->documents;
        // return response()->json(['documents' => $documents], 200);

        return view('Documents.show', compact('documents'));
    }

    public function deleteDocument($id)
    {
        $document = Document::findOrFail($id);

        if ($document->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        Storage::delete($document->file_path);
        $document->delete();

        return response()->json(['message' => 'Document deleted successfully'], 200);
    }

    public function approveDocument($id)
    {
        $document = Document::findOrFail($id);
        $document->status = 'approved';
        $document->save();

        return response()->json(['message' => 'Document approved successfully', 'document' => $document], 200);
    }
}
