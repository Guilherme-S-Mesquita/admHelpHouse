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

    protected $keyType = 'string';

    public $incrementing = false;
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


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function canJoinRoom($roomId)
    {
        $granted = false;
        $chatRoom = ChatRoom::findOrFail($roomId);
        $users = explode(':', $chatRoom->participant);

        foreach ($users as $id) {
            if ($this->id == $id) {
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
