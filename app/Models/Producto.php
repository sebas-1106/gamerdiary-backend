<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Producto extends Model
{
    protected $table = 'productos';
 
    protected $fillable = [
        'nombre_producto',
        'stock',
        'precio_compra',
        'proveedor_id',
    ];
 
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
 
 