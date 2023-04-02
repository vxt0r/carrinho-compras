<?php

namespace app\models;
use MF\model\Model;

class Carrinho extends Model{

    private function verificaProduto($id_produto,$qtd,$id_usuario){
        foreach($this->getProdutos($id_usuario) as $produto){
            if($produto['id'] == $id_produto){
               return $produto['qtd']; 
            }
        }
        return 0;
    }

    public function adicionarProduto($id_produto,$qtd,$id_usuario){ 

        $qtd_carrinho = $this->verificaProduto($id_produto,$qtd,$id_usuario);
            
        if($qtd_carrinho > 0){
            $qtd += $qtd_carrinho;
            $query = 'UPDATE carrinho SET qtd = ? WHERE id_produto = ? AND id_usuario = ?';
        }
        else $query = 'INSERT INTO carrinho(qtd,id_produto,id_usuario) VALUES (?,?,?)';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$qtd);
        $stmt->bindValue(2,$id_produto);
        $stmt->bindValue(3,$id_usuario);
        $stmt->execute();   
    }

    public function getProdutos($id_usuario){
        $query = '  SELECT produtos.id,nome,preco,qtd FROM carrinho
                    INNER JOIN produtos ON produtos.id = id_produto
                    WHERE carrinho.id_usuario = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$id_usuario);
        $stmt->execute(); 
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function limpar($id_usuario){
        $query = 'DELETE FROM carrinho WHERE id_usuario = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$id_usuario); 
        $stmt->execute();
    }

    public function removerProduto($id_produto,$id_usuario){
        $query = 'DELETE FROM carrinho WHERE id_produto = ? AND id_usuario = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$id_produto); 
        $stmt->bindValue(2,$id_usuario); 
        $stmt->execute();
    }

}