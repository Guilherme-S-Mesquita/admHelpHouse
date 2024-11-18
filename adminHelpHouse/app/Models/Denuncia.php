<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'tbDenuncia';

    protected $primaryKey = 'id';

    public $incrementing = false;


    protected $fillable = [
        'descricao',
        'idContratante',
        'idContratado',
        'status',
        'categoria',

    ];


    public function contratante()
    {
        return $this->belongsTo(Contratante::class, 'idContratante', 'idContratante');
    }

    public function contratado()
    {
        return $this->belongsTo(Profissional::class, 'idContratado', 'idContratado');
    }
}
