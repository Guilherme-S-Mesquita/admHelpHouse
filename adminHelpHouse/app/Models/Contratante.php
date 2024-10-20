<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ChatRoom;
use Illuminate\Support\Str;

class Contratante extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'tbcontratante';

    protected $primaryKey = 'idContratante';

    protected $keyType = 'string';

    public $incrementing = false;

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
<<<<<<< HEAD
        'cidadeContratante',
=======
        'cidadeContratante'
>>>>>>> a83faf1dca8dedbe982726cec47708020d5541bf
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

    public function canJoinRoom($roomId)
    {
        $granted = false;
        $chatRoom = ChatRoom::findOrFail($roomId);
        $contratantes = explode(':', $chatRoom->participant);

        foreach ($contratantes as $idContratante) {
            if ($this->idContratante == $idContratante) {
                $granted = true;
            }
        }

        return $granted;
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->idContratante = Str::orderedUuid();
        });
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'idContratante', 'idContratante');
    }
}
