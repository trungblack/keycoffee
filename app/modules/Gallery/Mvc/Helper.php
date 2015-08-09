<?php
/**
 * @copyright Copyright (c) 2011 - 2014 Oleksandr Torosh (http://wezoom.net)
 * @author Oleksandr Torosh <web@wezoom.net>
 */

namespace Gallery\Mvc;

use Gallery\Model\Gallery;

class Helper extends \Phalcon\Mvc\User\Component
{

    public function gallery($id)
    {
        $gallery = Gallery::findCachedById($id);
        $html = '';

        if ($gallery && count($gallery->cachedImages())) {
            $view = clone($this->getDI()->get('view'));
            $view->start();
            $view->setViewsDir(__DIR__ . '/../views/');
            $view->setPartialsDir('partials/');
            $view->partial('gallery/base', array('gallery' => $gallery));
            $html = ob_get_contents();
            $view->finish();
        }

        return $html;
    }

    public function carousel($id)
    {
        $gallery = Gallery::findCachedById($id);
        $html = '';

        if ($gallery && count($gallery->cachedImages())) {
            $view = clone($this->getDI()->get('view'));
            $view->start();
            $view->setViewsDir(__DIR__ . '/../views/');
            $view->setPartialsDir('partials/');
            $view->partial('gallery/carousel', array('gallery' => $gallery));
            $html = ob_get_contents();
            $view->finish();
        }

        return $html;
    }

    public function owlCarousel($id)
    {
        $gallery = Gallery::findCachedById($id);
        $html = '';

        if ($gallery && count($gallery->cachedImages())) {
            $view = clone($this->getDI()->get('view'));
            $view->start();
            $view->setViewsDir(__DIR__ . '/../views/');
            $view->setPartialsDir('partials/');
            $view->partial('gallery/owlCarousel', array('gallery' => $gallery));
            $html = ob_get_contents();
            $view->finish();
        }

        return $html;
    }


} 