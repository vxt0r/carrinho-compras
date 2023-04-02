<?php

namespace app\controllers;

use MF\controller\Action;
use MF\model\Container;
use app\models\Produto;
use app\models\Carrinho;

class IndexController extends Action{

    private function autenticado(){
        session_start();
        if(gettype($_SESSION['id_usuario']) != 'integer' || $_SESSION['id_usuario'] < 0){
            header('location:/login');
            exit();
        }
    }

    public function index(){
        $this->autenticado();
        $produto = Container::getModel('produto');
        $this->view->dados = $produto->getProdutos();
        $this->render('index','layout');
    }

    public function carrinho(){
        $this->autenticado();
        $carrinho = Container::getModel('carrinho');

        if(isset($_GET['adicionar'])){
            $carrinho->adicionarProduto($_POST['id'],$_POST['qtd'],$_SESSION['id_usuario']);
            header('location: /carrinho');
        }

        if(isset($_GET['limpar'])){
            $carrinho->limpar($_SESSION['id_usuario']);
            header('location: /carrinho');
        }

        if(isset($_GET['remover'])){
            $carrinho->removerProduto($_GET['id'],$_SESSION['id_usuario']);
            header('location: /carrinho');
        }

        $this->view->dados = $carrinho->getProdutos($_SESSION['id_usuario']);
        $_SESSION['dados'] = $this->view->dados;
        $this->render('carrinho','layout');
    }

    public function pedido(){
        $this->autenticado();

        if(isset($_GET['finalizado'])){
            
            if($_GET['finalizado'] == 1){
                $_SESSION['detalhes_compra'] = $_POST;
                header('location:pedido');
            }
    
            elseif($_GET['finalizado'] == 2){
                unset($_SESSION['detalhes_compra']);
                unset($_SESSION['dados']);
                Container::getModel('carrinho')->limpar($_SESSION['id_usuario']);
                header('location:/');
            }
        }

        if(!isset($_SESSION['dados']) || !isset($_SESSION['detalhes_compra'])){
            header('location:/');
        }
        
        $this->view->dados = $_SESSION['dados'];
        $this->render('pedido','layout');
    }
   
}

