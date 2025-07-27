<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
class ContactController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->ip();
        $key = 'contact-form:' . $ip;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return redirect()->back()
                ->withErrors(['message' => 'Has enviado demasiadas solicitudes. Intenta de nuevo en un minuto.'])
                ->withInput();
        }

        RateLimiter::hit($key, 60); // permite 5 envíos por minuto por IP

        // Honeypot
        if ($request->filled('website')) {
            return redirect()->back()->with('error', 'Solicitud rechazada por seguridad.');
        }

        // Filtro de palabras no deseadas
        $prohibidas = ['seo', 'marketing', 'publicidad', 'agencia', 'servicios', 'vender', 'estrategia'];
        foreach ($prohibidas as $palabra) {
            if (stripos($request->message, $palabra) !== false) {
                return redirect()->back()->with('error', 'Contenido no permitido en el mensaje.');
            }
        }

        // Validaciones estrictas
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u'],
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\+\-\s]+$/'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:2000',
                'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ¿¡,;.:\s\?\!\(\)\-"\']+$/u',
            ],
        ], [
            'message.regex' => 'Tu mensaje solo debe contener texto en español y signos comunes de puntuación.',
            'name.regex' => 'El nombre debe contener solo letras en español.',
            'phone.regex' => 'El teléfono solo puede contener números y símbolos como + o -.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Contact::create($request->all());

        try {
            Mail::to($request->email)->send(new ContactNotification($request->all()));
        } catch (\Exception $e) {
            Log::error('Error al enviar correo: '.$e->getMessage());
        }

        return redirect()->back()->with('success', '¡Gracias por tu mensaje! Te hemos enviado una confirmación por correo.');
    }

}