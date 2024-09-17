<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Contratante extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'tbcontratante';

    protected $primaryKey = 'idContratante';

    protected $fillable = [
        'idContratante',
        'nomeContratante',
        'cpfContratante',
        'password',
        'emailContratante',
        'telefoneContratante',
        'ruaContratante',
        'cepContratante',
        'numCasaContratante',
        'complementoContratante',
        'bairroContratante',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->password;
    }
}
