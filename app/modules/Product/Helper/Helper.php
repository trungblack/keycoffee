<?php
/**
 * @copyright Copyright (c) 2011 - 2014 Oleksandr Torosh (http://wezoom.net)
 * @author Oleksandr Torosh <web@wezoom.net>
 */

namespace Product\Helper;


use Product\Model\Product;
use Product\Model\Type;

class Helper extends \Phalcon\Mvc\User\Component
{

    public function generateProductMenuItems()
    {
        $types = Type::find();

        if (count($types) > 0) {
            $cols =  round(12/count($types));
            $view = clone($this->getDI()->get('view'));
            $view->start();
            $view->setViewsDir(__DIR__ . '/../views/');
            $view->setPartialsDir('partials/');

            $view->partial('menu/base', array('types' => $types,'cols' => $cols));
            $html = ob_get_contents();
            $view->finish();
        }
        return $html;
    }
    public function generateProductHomeItems()
    {
        $types = Type::find();

        if (count($types) > 0) {
            $cols =  count($types);
            $view = clone($this->getDI()->get('view'));
            $view->start();
            $view->setViewsDir(__DIR__ . '/../views/');
            $view->setPartialsDir('partials/');

            $view->partial('home/base', array('types' => $types,'cols' => $cols));
            $html = ob_get_contents();
            $view->finish();
        }
        return $html;
    }


} 