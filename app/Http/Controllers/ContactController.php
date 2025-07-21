<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Almacenar en la base de datos
        Contact::create($request->all());
        

        // Enviar correo de notificación
        try {
            Mail::to($request->email)->send(new ContactNotification($request->all()));
        } catch (\Exception $e) {
            // Puedes loggear el error si quieres
            Log::error('Error al enviar correo: '.$e->getMessage());
        }

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto. Te hemos enviado un correo de confirmación.');
    }
}