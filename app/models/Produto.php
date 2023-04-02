<?php

namespace app\models;
use MF\model\Model;

class Produto extends Model{

    
    private string $nome;
    private float $preco;
    private int $qtd;
    private float $sub_total;

    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }

    public function getProdutos(){
        $query = 'select id,nome,preco,imagem from produtos';
        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function adicionar(){
        
    }
}