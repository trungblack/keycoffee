<?php

/**
 * Routes
 * @copyright Copyright (c) 2011 - 2014 Aleksandr Torosh (http://wezoom.com.ua)
 * @author Aleksandr Torosh <webtorua@gmail.com>
 */

namespace Index;

class Routes
{

    public function init($router)
    {
        $router->addML('/', array(
            'module' => 'index',
            'controller' => 'index',
            'action' => 'index',
        ), 'index');

        $router->addML('/contacts', array(
            'module' => 'index',
            'controller' => 'index',
            'action' => 'contacts',
        ), 'contacts');

        $router->addML('/products', array(
            'module' => 'index',
            'controller' => 'index',
            'action' => 'products',
        ), 'products');
        $router->addML('/moc-khoa', array(
            'module' => 'index',
            'controller' => 'index',
            'action' => 'contacts',
        ), 'moc_khoa');
        return $router;

    }

}