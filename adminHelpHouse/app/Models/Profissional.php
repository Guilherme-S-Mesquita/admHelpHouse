<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profissional extends Authenticatable
{
    use HasFactory,  Notifiable, HasFactory;

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


    public function getAuthPassword()
    {
        return $this->password;
    }
}
