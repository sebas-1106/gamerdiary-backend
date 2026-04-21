<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class AsignacionTecnico extends Model
{
    protected $table = 'asignacion_tecnicos';
 
    protected $fillable = [
        'cita_id',
        'empleado_id',
        'fecha_asignacion',
    ];
 
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }
 
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}