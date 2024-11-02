<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'tbAvaliacao';

    protected $fillable = ['idContratado', 'idContratante', 'ratingAvaliacao', 'descavaliacao'];


    public function contratante()
    {
        return $this->belongsTo(Contratante::class, 'idContratante', 'idContratante');
    }

    public function contratado()
    {
        return $this->belongsTo(Profissional::class, 'idContratado', 'idContratado');
    }
}
