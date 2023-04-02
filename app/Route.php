<?php

namespace app;

use MF\init\Bootstrap;

class Route extends Bootstrap{

    protected function initRoutes(){

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' =>  'index'
        );
        
        $routes['carrinho'] = array(
            'route' => '/carrinho',
            'controller' => 'indexController',
            'action' =>  'carrinho'
        );

        $routes['pedido'] = array(
            'route' => '/pedido',
            'controller' => 'indexController',
            'action' =>  'pedido'
        );

        $routes['cadastrar'] = array(
            'route' => '/cadastrar',
            'controller' => 'authController',
            'action' =>  'cadastrar'
        );

        $routes['login'] = array(
            'route' => '/login',
            'controller' => 'authController',
            'action' =>  'login'
        );

        $routes['logout'] = array(
            'route' => '/logout',
            'controller' => 'authController',
            'action' =>  'logout'
        );

        $this->setRoutes($routes);
    }
       
}