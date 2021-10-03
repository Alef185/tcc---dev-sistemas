<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    //definindo a chave primaria do idioma
    public function filmes(){
        return $this->hasMany(Filme::class, 'idioma_id');
    }
}
