<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrinhoProdutos extends Model
{
    use HasFactory;
    protected $fillable = ['carrinho_id','produto_id','qtd'];
    public $timestamps = false;
    
}
