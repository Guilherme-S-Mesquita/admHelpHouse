<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $table = 'tbcontratado';


    public $fillable = ['idContratado', 'nomeContratado', 'cpfContratado
    emailContratado', 'telefoneContratado', 'senhaContratado', 'profissaoContratado',
    'descContratado', 'nascContratado'];

    public $timestamps = false;
}
