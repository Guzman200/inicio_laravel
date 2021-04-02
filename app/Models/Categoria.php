<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "categorias";
    protected $fillable = ['descripcion'];

    // relación con productos
    public function productos(){
        return $this->hasMany(Material::class);
    }
    
}
