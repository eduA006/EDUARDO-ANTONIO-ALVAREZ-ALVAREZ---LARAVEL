<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function productos() //sirve para relacionar las categorias con los productos
    {
        return $this->hasMany(Producto::class); // una categoria tiene muchos productos
    }
}
