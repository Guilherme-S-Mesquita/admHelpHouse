<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratante extends Model
{
    use HasFactory;

    protected $table = 'tbcontratante';

    public $fillable = [
                        'idContratante', 
                        'nomeContratante',
                        'sobrenomeContratante',
                        'cpfContratante',
                        'password',
                        'emailContratante',
                        'telefoneContratante',
                        'idEndereco'
                       ];

    public $timestamps = false;




}
