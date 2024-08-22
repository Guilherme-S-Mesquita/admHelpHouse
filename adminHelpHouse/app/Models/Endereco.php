<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;


    protected $table = 'tbenderecos';

    protected $fillable = [

        'idEndereco',
        'ruaEndereco',
        'cepEndereco',
        'numCasaEndereco',
        'complementoEndereco',
        'bairroEndereco',
        'ufEndereco',
        'cidadeEndereco',
    ];

    public $timestamps = false;
}
