<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'actor'; // Nombre de la tabla en la base de datos Sakila

    protected $primaryKey = 'actor_id'; // Clave primaria de la tabla

    protected $fillable = ['first_name', 'last_name']; // Campos que se pueden asignar masivamente

    // Relaciones si las hubiera, por ejemplo:
    // public function películas() {
    //     return $this->belongsToMany(Película::class);
    // }
}
