<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si es diferente del nombre del modelo en plural
    protected $table = 'category';

    // Especifica la clave primaria si es diferente de 'id'
    protected $primaryKey = 'category_id';

    // Desactiva las marcas de tiempo automáticas si no están presentes en la tabla
    public $timestamps = false;

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = ['name', 'last_update'];

    // Si necesitas definir relaciones, puedes hacerlo aquí
    // Por ejemplo, si una categoría tiene muchas películas:
    /*
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_category', 'category_id', 'film_id');
    }
    */
}

