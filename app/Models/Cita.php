<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Cita extends Model
{
    protected $table = 'citas';
 
    protected $fillable = [
        'usuario_id',
        'servicio_id',
        'fecha_cita',
        'hora_cita',
        'estado',
        'observaciones',
    ];
 
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
 
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
 
    public function asignaciones()
    {
        return $this->hasMany(AsignacionTecnico::class, 'cita_id');
    }
}