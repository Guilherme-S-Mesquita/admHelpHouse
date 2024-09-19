<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_room_id',
        'user_id',
        'message',
        'is_read',
    ];
    protected $connection = "mysql";


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::orderedUuid();
        });
    }
}