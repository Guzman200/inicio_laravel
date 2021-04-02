<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = "materiales";

    protected $fillable = ['nombre','categoria_id','acabado','cantidad'];

    // relación con categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
