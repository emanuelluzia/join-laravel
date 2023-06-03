<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'tb_produto';

    protected $primaryKey = 'id_produto';


    protected $fillable = [
        'id_produto',
        'nome_produto',
        'valor_produto',
        'id_categoria_produto',
        'created_at'

    ];
    
    protected $appends = ['cadastroFormat'];

    public function getCadastroFormatAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['created_at']));
    }

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria_produto', 'id_categoria_planejamento');
    }

    
}
