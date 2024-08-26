<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $table = 'tbcontratado';

    protected $fillable = [
        'nomeContratado',
        'sobrenomeContratado',
        'cpfContratado',
        'emailContratado',
        'telefoneContratado',
        'password',
        'profissaoContratado',
        'descContratado',
        'nascContratado',
        'ruaContratado',
        'cepContratado',
        'numCasaContratado',
        'complementoContratado',
        'bairroContratado',
        'ufContratado',
        'cidadeContratado',
    ];


    public $timestamps = false;
}
