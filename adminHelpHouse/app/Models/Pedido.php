<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'tbSolicitarPedido';

    // Especifica a chave primária da tabela
    protected $primaryKey = 'idSolicitarPedido';

    // Indica que a chave primária não é auto-incrementável, se for o caso
    public $incrementing = false;

    // Especifica o tipo da chave primária
    protected $keyType = 'int'; // ou 'string', dependendo do tipo

    protected $hidden = [
        'remember_token',
    ];
    protected $fillable = ['descricaoPedido', 'idContratante', 'idServicos', 'idContratado', 'tituloPedido', 'statusPedido'];

    public function contratante()
    {
        return $this->belongsTo(Contratante::class, 'idContratante', 'idContratante');
    }
    public function contratado()
    {
        return $this->belongsTo(Profissional::class, 'idContratado', 'idContratado');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'idServicos', 'idServicos');
    }
}
