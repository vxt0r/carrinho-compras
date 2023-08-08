<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    public $fillable = ['nome','preco','imagem'];
    public $timestamps = false;

    public function carrinho()
    {
        return $this->belongsToMany(Carrinho::class,'carrinho_produtos');
    }

    public static function rules()
    {
        return [
            'nome' => 'required',
            'preco'=> 'required',
            'imagem' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public static function feedback()
    {
        return [
            'required' => 'Campo obrigatório',
            'mimes' => 'Insira um tipo de arquivo válido (jpeg, png, jpg)'
        ];
    }
    
}
