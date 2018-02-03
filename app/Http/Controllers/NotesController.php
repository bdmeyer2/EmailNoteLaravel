<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendNote;

class NotesController extends Controller
{

    /**
     * Send an email to the $request->email with the message $request->message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendNote(Request $request)
    {
        $iCloudID = $request->iCloudID;

        if(is_null($iCloudID)) {
            abort(403);
        }
        
        $note = $request->message;
        $email = $request->email;

        \Mail::to($email)->send(new SendNote($note));

        return response()->json($note);
    }
}
