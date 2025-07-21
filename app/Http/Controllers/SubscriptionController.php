<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'is_active' => true
        ]);

        // Enviar correo de confirmación
        try {
            Mail::to($request->email)->send(new SubscriptionConfirmation($request->email));
        } catch (\Exception $e) {
            // Puedes loggear el error si quieres
            Log::error('Error al enviar correo: '.$e->getMessage());
        }

        // Redireccionar con mensaje de éxito
        return redirect()->back()
            ->with('success', '¡Gracias por suscribirte! Te hemos enviado un correo de confirmación.');
    }
}