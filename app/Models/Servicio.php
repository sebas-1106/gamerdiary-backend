<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Servicio extends Model
{
    protected $table = 'servicios';
 
    protected $fillable = [
        'nombre_servicio',
        'descripcion',
        'precio',
        'categoria',
        'imagen_url',
    ];
 
    public function citas()
    {
        return $this->hasMany(Cita::class, 'servicio_id');
    }
}
 