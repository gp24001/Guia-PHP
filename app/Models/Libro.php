<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';

    protected $fillable = [
        'titulo',
        'año_publicacion',
        'id_categoria',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'libro_autor', 'id_libro', 'id_autor')
            ->using(LibroAutor::class);
    }

    public function detallePrestamos(): HasMany
    {
        return $this->hasMany(DetallePrestamo::class, 'id_libro');
    }

    public function prestamos(): BelongsToMany
    {
        return $this->belongsToMany(Prestamo::class, 'detalle_prestamo', 'id_libro', 'id_prestamo');
    }
}