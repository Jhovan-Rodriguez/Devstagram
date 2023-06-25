<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Son los datos que se va a llenar en la DB
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Crea relacion Belongs To, un post pertenece a un usuario
    public function user()
    {
        // belongsTo() es la relacion Belongs To
        return $this->belongsTo(User::class)->select(['name', 'username']); // select() para traer los campos solicitados

    }

    //Relacion con el modelo de comentarios
    public function comentario()
    {
        return $this->hasMany(Comentario::class);
    }

}
