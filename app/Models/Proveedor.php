<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Proveedor extends Model
{
    protected $table = 'proveedores';
 
    protected $fillable = [
        'nombre_empresa',
        'contacto_nombre',
        'telefono',
        'email',
        'categoria_suministro',
    ];
 
    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }
}
 