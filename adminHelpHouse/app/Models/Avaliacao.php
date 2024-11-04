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
                            'descavaliacao'
                          ];

    public $timestamps = false;

}
