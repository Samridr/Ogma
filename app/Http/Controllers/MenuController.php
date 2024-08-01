<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class MenuController extends Controller
{
   //
   public function indexDocs(){
    $docs = Document::orderBy('Created_at','DESC')->get();
    return view('Documents.index',compact('docs'));
   }


    public function indexGesDocs(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('GestionDesDocuments.index',compact('docs'));
    }

    public function indexGesDoss(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('GestionDesDossiers.index',compact('docs'));
    }

    public function indexGesUsers(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('GestionDesUtilisateurs.index',compact('docs'));
    }

    public function indexClient(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('Clients.index',compact('docs'));
    }

    public function indexMessage(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('Messages.index',compact('docs'));
    }

    public function indexNotif(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('Notifications.index',compact('docs'));
    }

    public function indexProfil(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('Profil.index',compact('docs'));
    }

    public function indexSupp(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('Support.index',compact('docs'));
    }


}

