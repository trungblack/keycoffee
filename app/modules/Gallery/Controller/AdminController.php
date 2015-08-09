<?php

namespace Gallery\Controller;

use Application\Mvc\Controller;
use Gallery\Model\Gallery;
use Gallery\Model\GalleryImage as Image;
use Gallery\Form\GalleryForm;

class AdminController extends Controller
{

    private $key = 'gallery-inner-'; // use in template - {{ helper.getGallery(gallery ID) }}

    private $allowedFormats = array(
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
    );

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-gallery');
        $this->view->languages_disabled = true;

    }

    public function indexAction()
    {
        $this->view->entries = Gallery::find();
        $this->view->title = $this->helper->at('Manage Gallery');
    }

    public function addAction()
    {
        $this->view->pick('admin/edit');
        $form = new GalleryForm();
        $model = new Gallery();

        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $model);
            if ($form->isValid()) {
                if ($model->save()) {
                    $this->flash->success($this->helper->at('Gallery created'));
                    $this->uploadImages($model->getId());
                    return $this->redirect('/gallery/admin/edit/' . $model->getId());

                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        } else {
            $form->setEntity($model);
        }

        $this->view->setVars(array(
            'form' => $form,
            'title' => $this->helper->at('Adding a gallery')
        ));
    }

    public function editAction($id)
    {
        $id = (int)$id;
        $form = new GalleryForm();
        $model = Gallery::findFirst(array("id = $id"));

        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $model);
            if ($form->isValid()) {
                $this->uploadImages($model->getId());
                if ($model->save()) {
                    $this->flash->success($this->helper->at('Gallery edited'));
                    return $this->redirect('/gallery/admin/edit/' . $model->getId());
                } else {
                    $this->flash->error($this->helper->at('Errors while editing gallery!'));
                    $this->flashErrors($model);
                }

            } else {
                $this->flashErrors($form);
            }
        } else {
            $form->setEntity($model);
        }

        $this->view->setVars(array(
            'form' => $form,
            'model' => $model,
            'title' => $this->helper->at('Editing the gallery')
        ));
    }

    public function deleteAction($id)
    {
        $id = (int)$id;
        $model = Gallery::findFirst($id);

        if ($this->request->isPost()) {
            foreach ($model->GalleryImages as $img)
            {
                $imageFilter = new \Image\Storage(array(
                    'id' => $img->getId(),
                    'type' => 'gallery'
                ));
                $imageFilter->remove(true);
            }
            $model->delete();
            return $this->redirect('/gallery/admin');
        }

        $this->view->model = $model;
        $this->helper->title($this->helper->at('Removing gallery'), true);
    }

    public function deleteImageAction()
    {
        $id = $this->request->getPost('id', 'int');
        $this->view->cleanTemplateBefore();
        $result = false;

        $model = Image::findFirst(array('id = ' . $id));

        if ($model) {
            $imageFilter = new \Image\Storage(array(
                'id' => $id,
                'type' => 'gallery'
            ));
            $imageFilter->remove(true);

            if ($model->delete()) {
                $result = true;
            }
        }

        $this->returnJSON(array('success' => $result));
    }

    public function saveGalleryAction()
    {
        $gallery_id = $this->request->getPost('gallery', 'int');
        $itemsData = $this->request->getPost('items');

        if (count($itemsData)){
            foreach ($itemsData as $k => $v) {
                $imageModel = Image::findFirst('id = ' . $k . ' AND gallery_id = ' . $gallery_id);
                $imageModel->setSortOrder($v['sort']);
                $imageModel->setCaption($v['text']);
                $imageModel->setLink($v['link']);
                $imageModel->update();
            }
        }

        $this->returnJSON(array('success' => 'true'));
    }

    public function uploadImages($id)
    {
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file) {

                    if (in_array($file->getRealType(), $this->allowedFormats)) {
                        $image = new \Gallery\Model\GalleryImage();
                        $image->setGalleryId($id);
                        $image->save();

                        $imageFilter = new \Image\Storage(array(
                            'id' => $image->getId(),
                            'type' => 'gallery',
                        ));
                        $imageFilter->remove(false);
                        $file->moveTo($imageFilter->originalAbsPath());
                    } else {
                        $this->flash->error($this->helper->at('Only allow to upload the images with the extension jpg, jpeg, png, gif! '. $file->getName() .' - не загружен.' ));
                    }
                }

            }
        }
    }

}