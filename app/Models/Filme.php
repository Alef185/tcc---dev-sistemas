<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descricao', 'ano_lancamento', 'idioma_id',
    ];

    //defne um relaciionamento no model
    public function idoma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }
}