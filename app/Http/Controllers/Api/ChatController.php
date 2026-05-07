<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MensajeChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function enviarMensaje(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string',
        ]);

        $apiKey = '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';
        $mensaje = $request->mensaje;

        $response = Http::timeout(30)->withHeaders([
            'Authorization' => "Bearer {$apiKey}",
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.1-8b-instant',
            'messages' => [
                [
                    'role'    => 'system',
                    'content' => 'Eres un asistente experto en setups gaming. Ayuda al usuario a elegir periféricos, iluminación y mobiliario para su espacio gamer. Responde siempre en español de forma concisa y amigable.'
                ],
                [
                    'role'    => 'user',
                    'content' => $mensaje
                ]
            ]
        ]);

        $respuestaIA = $response->json('choices.0.message.content') ?? 'No se pudo obtener respuesta.';

        MensajeChat::create([
            'usuario_id'   => $request->user()->id,
            'mensaje'      => $mensaje,
            'respuesta_ia' => $respuestaIA,
        ]);

        return response()->json([
            'mensaje'      => $mensaje,
            'respuesta_ia' => $respuestaIA,
            'debug'        => $response->json(),
            'status'       => $response->status(),
        ]);
    }

    public function historial(Request $request)
    {
        $mensajes = MensajeChat::where('usuario_id', $request->user()->id)
            ->orderBy('fecha_envio', 'asc')
            ->get();

        return response()->json($mensajes);
    }
}
