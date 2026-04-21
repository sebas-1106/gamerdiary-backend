<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajeChat extends Model
{
    protected $table = 'mensajes_chat';

    protected $fillable = [
        'usuario_id',
        'mensaje',
        'respuesta_ia',
        'fecha_envio',
    ];

    public $timestamps = false; // añade esta línea

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}