<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChatRoom;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profissional extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'tbcontratado';

    protected $primaryKey = 'idContratado'; // Nome da chave primária
    protected $keyType = 'string'; // Tipo da chave primária
    public $incrementing = false; // Desativa incremento automático

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

    public $timestamps = true; // Ativa timestamps se sua tabela tiver created_at e updated_at

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canJoinRoom($roomId)
    {
        $granted = false;
        $chatRoom = ChatRoom::findOrFail($roomId);
        $contratados = explode(':', $chatRoom->participant);

        foreach ($contratados as $idContratado) {
            if ($this->idContratado == $idContratado) {
                $granted = true;
            }
        }

        return $granted;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->idContratado = (string) Str::uuid();
        });
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
