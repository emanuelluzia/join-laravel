<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'tb_categoria_produto';

    protected $primaryKey = 'id_categoria_planejamento';


    protected $fillable = [
        'id_categoria_planejamento',
        'nome_categoria',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'id_categoria_planejamento', 'id_produto');
    }

   
}
