<?php

/**
 * Routes
 * @copyright Copyright (c) 2011 - 2014 Aleksandr Torosh (http://wezoom.com.ua)
 * @author Aleksandr Torosh <webtorua@gmail.com>
 */

namespace Product;

use Product\Model\Product;
use Product\Model\Type;

class Routes
{

    public function init($router)
    {
        $types_keys = array_keys(Type::cachedListArray());
        $types_regex = '(' . implode('|', $types_keys) . ')';

        $router->add('/product/admin/{type:' . $types_regex . '}', array(
            'module' => 'product',
            'controller' => 'admin',
            'action' => 'index'
        ))->setName('products_admin');

        $router->add('/product/admin/{type:' . $types_regex . '}/([a-zA-Z0-9_]+)', array(
            'module' => 'product',
            'controller' => 'admin',
            'action' => 2
        ))->setName('products_admin_action');

        $router->addML('/{type:' . $types_regex . '}', array(
            'module' => 'product',
            'controller' => 'index',
            'action' => 'index'
        ),'products');

        $router->addML('/{type:' . $types_regex . '}/{slug:[a-zA-Z0-9_-]+}.html', array(
            'module' => 'product',
            'controller' => 'index',
            'action' => 'product'
        ),'product');

        return $router;

    }

}