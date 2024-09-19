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
    use HasFactory,  Notifiable, HasFactory;

    protected $table = 'tbcontratado';

    protected $keyType = 'string';

    public $incrementing = false;

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

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::orderedUuid();
        });
    }
}
