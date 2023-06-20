<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;
    public $fillable = ['user_id'];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produto()
    {
        return $this->belongsToMany(Produto::class,'carrinho_produtos');
    }

    public function carrinhoProdutos()
    {
        return $this->hasMany(CarrinhoProdutos::class,'carrinho_id','id');
    }
    
}
