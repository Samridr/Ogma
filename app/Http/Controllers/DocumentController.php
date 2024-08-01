<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    //
    public function index(){
        $docs = Document::orderBy('Created_at','DESC')->get();
        return view('User.index',compact('docs'));
    }
}
