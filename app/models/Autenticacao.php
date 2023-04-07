<?php

namespace app\models;
use MF\model\Model;

class Autenticacao extends Model{

    private function verificarCadastro(string $email):array{
        $query = 'SELECT id FROM usuario WHERE email = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function cadastrar(string $nome,string $email,string $senha):void{
        if(!$this->verificarCadastro($email)){
            $hash = password_hash($senha,PASSWORD_DEFAULT);
            $query = 'INSERT INTO usuario(nome,email,senha) VALUES(?,?,?)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$nome);
            $stmt->bindValue(2,$email);
            $stmt->bindValue(3,$hash);
            $stmt->execute();
            header('location:/login');
        }
        else die('O usuário já existe');
    }

    public function login(string $email,string $senha):void{
        $query = 'SELECT id,senha FROM usuario WHERE email = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$email);
        $stmt->execute();
        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(password_verify($senha,$usuario['senha'])) {
            session_start();
            $_SESSION['id_usuario'] = $usuario['id'];
            header('location:/');
        }
        else die('Email ou senha incorretos');

    }
}
