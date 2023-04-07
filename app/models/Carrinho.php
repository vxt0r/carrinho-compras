<?php

namespace app\models;
use MF\model\Model;

class Carrinho extends Model{

    private function verificaProduto(int $id_produto, int $qtd,int $id_usuario):int {
        foreach($this->getProdutos($id_usuario) as $produto){
            if($produto['id'] == $id_produto){
               return intval($produto['qtd']);
            }
        }
        return 0;
    }

    public function adicionarProduto(int $id_produto,int $qtd,int $id_usuario):void{

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

    public function getProdutos(int $id_usuario):array{
        $query = '  SELECT produto.id,nome,preco,qtd FROM carrinho
                    INNER JOIN produto ON produto.id = id_produto
                    WHERE carrinho.id_usuario = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function limpar(int $id_usuario):void{
        $query = 'DELETE FROM carrinho WHERE id_usuario = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$id_usuario);
        $stmt->execute();
    }

    public function removerProduto(int $id_produto,int $id_usuario):void{
        $query = 'DELETE FROM carrinho WHERE id_produto = ? AND id_usuario = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$id_produto);
        $stmt->bindValue(2,$id_usuario);
        $stmt->execute();
    }

}
