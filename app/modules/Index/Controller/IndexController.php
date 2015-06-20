<?php

namespace Index\Controller;

use Application\Mvc\Controller;
use Page\Model\Page;
use Phalcon\Exception;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->bodyClass = 'home';
        $page = Page::findCachedBySlug('index');
        if (!$page) {
            throw new Exception("Page 'index' not found");
            return;
        }
        $this->helper->title()->append($page->getMeta_title());
        $this->helper->meta()->set('description', $page->getMeta_description());
        $this->helper->meta()->set('keywords', $page->getMeta_keywords());
        $this->view->page = $page;
        $this->helper->activeMenu()->setActive('index');
//        $this->helper->menu->setActive('index');

    }

    public function contactsAction()
    {

        $page = Page::findCachedBySlug('contacts');
        if (!$page) {
            throw new Exception("Page 'contacts' not found");
            return;
        }

        $this->helper->title()->append($page->getMeta_title());
        $this->helper->meta()->set('description', $page->getMeta_description());
        $this->helper->meta()->set('keywords', $page->getMeta_keywords());
        $this->view->page = $page;

        $this->helper->activeMenu()->setActive('contacts');
    }
    public function productsAction()
    {
        $page = Page::findCachedBySlug('products');
        if (!$page) {
            throw new Exception("Page 'products' not found");
            return;
        }

        $this->helper->title()->append($page->getMeta_title());
        $this->helper->meta()->set('description', $page->getMeta_description());
        $this->helper->meta()->set('keywords', $page->getMeta_keywords());
        $this->view->page = $page;
        $this->helper->activeMenu()->setActive('products');
//        $this->helper->menu->setActive('products');
    }

}
