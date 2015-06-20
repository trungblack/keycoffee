<?php

namespace Product\Controller;

use Application\Mvc\Controller;
use Product\Model\Product;
use Phalcon\Exception;
use Product\Model\Type;

class IndexController extends Controller
{

    public function indexAction()
    {
        $type = $this->dispatcher->getParam('type','string');
        $typeModel = Type::getCachedBySlug($type);
        if (!$typeModel) {
            throw new Exception("Product hasn't type = '$type''");
        }
        $products = Product::find(array(
            "type_id = {$typeModel->getId()}",
            "order" => "date DESC",
        ));

        $this->helper->title()->append($typeModel->getHead_title());
        $this->view->title = $typeModel->getTitle();
        $this->view->type = $typeModel;
        $this->view->products = $products;
        $this->view->product = $products[0];
        $this->helper->activeMenu()->setActive('product');

    }

    public function productAction()
    {
        $slug = $this->dispatcher->getParam('slug','string');
        $type = $this->dispatcher->getParam('type','string');
        $typeModel = Type::getCachedBySlug($type);
        if (!$typeModel) {
            throw new Exception("Product hasn't type = '$type''");
        }

        $products = Product::find(array(
            "type_id = {$typeModel->getId()}",
            "order" => "date DESC",
        ));

        $product = Product::findCachedBySlug($slug);
        if (!$product) {
            throw new Exception("Product '$slug.html' not found");
            return;
        }
        if ($product->getTypeSlug() != $type) {
            throw new Exception("Product type <> $type");
            return;
        }

        $this->helper->title()->append($product->getMeta_title());
        $this->helper->meta()->set('description', $product->getMeta_description());
        $this->helper->meta()->set('keywords', $product->getMeta_keywords());
        $this->view->types = Type::find();
        $this->view->type = $typeModel;
        $this->view->products = $products;
        $this->view->product = $product;
        $this->helper->activeMenu()->setActive('product');

    }

} 