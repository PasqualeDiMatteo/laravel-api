<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function message(Request $request)
    {
        //Recupero i dati dal form
        $data = $request->all();

        // Valido i campi
        $validator = Validator::make($data, [
            "email" => "required|email",
            "subject" => "required|string",
            "content" => "required|string",
        ], [
            "email.required" => "La mail è obbligatoria",
            "email.email" => "La mail inserita non è valida",
            "subject.required" => "La mail deve contenere l'oggetto",
            "content.required" => "La mail deve contenere un contenuto"
        ]);

        // Se c'è un errore, li mando indietro
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 400);
        }

        // Preparo la mail
        $mail = new ContactMessageMail(
            sender: $data["email"],
            subject: $data["subject"],
            content: $data["content"],
        );

        // Invio la mail
        Mail::to(env("MAIL_TO_ADDRESS"))->send($mail);
        return response(null, 204);
    }
}
