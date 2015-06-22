<?php
/**
 * @copyright Copyright (c) 2011 - 2014 Oleksandr Torosh (http://wezoom.net)
 * @author Oleksandr Torosh <web@wezoom.net>
 */

namespace Product\Controller;

use Application\Mvc\Controller;
use Product\Form\TypeForm;
use Product\Model\Type;

class TypeController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
    }

    public function indexAction()
    {
        $this->view->entries = Type::find();

        $this->view->title = 'Manage Types of Product';
        $this->helper->title($this->view->title);
    }

    public function addAction()
    {
        $this->view->pick(array('type/edit'));

        $form = new TypeForm();
        $model = new Type();

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    $model->updateFields($post);
                    if ($model->update()) {
                        $this->flash->success('Type created');
                        return $this->redirect('/product/type/edit/' . $model->getId() . '?lang=' . LANG);
                    } else {
                        $this->flashErrors($model);
                    }
                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        }

        $this->view->model = $model;
        $this->view->form = $form;

        $this->view->title = 'Добавление типа публикаций';
        $this->helper->title($this->view->title);
    }

    public function editAction($id)
    {
        $form = new TypeForm();
        $model = Type::findFirst($id);

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                $model->updateFields($post);
                if ($model->update()) {
                    $this->flash->success('Type created');
                    return $this->redirect('/product/type/edit/' . $model->getId() . '?lang=' . LANG);
                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        } else {
            $form->setEntity($model);
        }

        $this->view->model = $model;
        $this->view->form = $form;

        $this->view->title = 'Manage Type of Products';
        $this->helper->title($this->view->title);
    }

    public function deleteAction($id)
    {
        $model = Type::findFirst($id);
        $count = Type::count();
        if ($count == 1) {
            $this->flash->error('Can not Delete the last Type');
            return;
        }

        if ($this->request->isPost()) {
            $model->delete();
            $this->redirect('/product/type');
        }

        $this->view->model = $model;

        $this->view->title = 'Delete Type';
        $this->helper->title($this->view->title);
    }

} 