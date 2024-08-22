<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $table = 'tbcontratado';

    protected $fillable = [
        'idContratado',
        'nomeContratado',
        'sobrenomeContratado', // Adicione esta linha
        'cpfContratado',
        'emailContratado',
        'telefoneContratado',
        'senhaContratado',
        'profissaoContratado',
        'descContratado',
        'nascContratado',
        'password',
        'idEndereco'

    ];

    public $timestamps = false;
}
