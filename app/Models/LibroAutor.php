<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LibroAutor extends Pivot
{
    protected $table = 'libro_autor';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id_libro',
        'id_autor',
    ];

    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class, 'id_libro');
    }

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class, 'id_autor');
    }
}