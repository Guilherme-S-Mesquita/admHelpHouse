<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'tbavaliacao';

    protected $fillable = ['idContratado',
                            'idContratante',
                            'ratingAvaliacao',
                            'descavaliacao',
                            'imagem',
                            'nome',
                          ];


                          public function contratado()
                          {
                              return $this->belongsTo(Contratado::class, 'idContratado');
                          }
                          
    public function contratante()
{
    return $this->belongsTo(Contratante::class, 'idContratante', 'idContratante');
}
                          

    public $timestamps = false;

}
