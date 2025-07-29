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
        // Anti-spam: Palabras bloqueadas (español e inglés)
        $spamKeywords = [
            'seo', 'marketing', 'agency', 'agencia', 'promoción', 'promocion',
            'posicionamiento', 'optimizaci[oó]n', 'followers', 'likes', 'trafic[oó]', 'ganancias',
            'ventas', 'incrementa.*ventas', 'publicidad', 'redes sociales', 'diseño web', 'aumenta tus visitas', 'clicks', 'inbound', 'links', 'backlinks', 'Authority', 'influencer', 'influencers', 'viral', 'tráfico web', 'tráfico orgánico', 'tráfico pagado', 'conversión', 'conversión de leads', 'leads', 'email marketing', 'campañas de email', 'campañas de marketing digital'
        ];

        // Validación estándar
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Honeypot: campo oculto no debe estar lleno
        if (!empty($request->input('website')) || $request->input('accept_terms')) {
            return redirect()->back()->withErrors(['error' => 'Solicitud bloqueada.'])->withInput();
        }

        // Detectar palabras de spam
        $textToCheck = strtolower($request->input('subject') . ' ' . $request->input('message'));
        foreach ($spamKeywords as $keyword) {
            if (preg_match('/' . $keyword . '/i', $textToCheck)) {
                return redirect()->back()->withErrors(['error' => 'Contenido promocional o no deseado detectado.'])->withInput();
            }
        }

        // Guardar mensaje
        Contact::create($request->only(['name', 'email', 'phone', 'subject', 'message']));

        // Enviar correo
        try {
            Mail::to($request->email)->send(new ContactNotification($request->all()));
        } catch (\Exception $e) {
            Log::error('Error al enviar correo: '.$e->getMessage());
        }

        return redirect()->back()->with('success', '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto. Te hemos enviado un correo de confirmación.');
    }

}