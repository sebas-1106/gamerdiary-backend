<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'usuario_id',
        'dni',
        'especialidad',
        'disponibilidad',
    ];
 
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
 
    public function asignaciones()
    {
        return $this->hasMany(AsignacionTecnico::class, 'empleado_id');
    }
}