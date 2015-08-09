<?php
/**
 * Created by PhpStorm.
 * User: office-pb1
 * Date: 07.07.14
 * Time: 22:48
 */

namespace Product\Form;

use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Application\Form\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use \Phalcon\Forms\Element\File;
use Product\Model\Type;
use Gallery\Model\Gallery;


class ProductForm extends Form
{

    public function initialize()
    {
        $type = new Select('type_id', Type::cachedListArray(array('key' => 'id')), array());
        $type->setLabel('Type of Product');
        $this->add($type);

        $title = new Text('title', array('required' => true));
        $title->addValidator(new PresenceOf(array(
            'message' => 'Title can not be empty'
        )));
        $title->setLabel('Title');
        $this->add($title);

        $gallery = new Select('gallery_id', Gallery::find(),array('using'=>array('id','title')));
        $gallery->setLabel('Gallery');
        $this->add($gallery);

        $slug = new Text('slug');
        $slug->setLabel('Slug');
        $this->add($slug);

        $date = new Text('date');
        $date->setLabel('Published Date');
        $this->add($date);


        $item = new Text('price');
        $item->setLabel('Price');
        $this->add($item);

        $item = new Text('package');
        $item->setLabel('Package');
        $this->add($item);

        $text = new TextArea('short_description');
        $text->setLabel('Short Description');
        $this->add($text);

        $text = new TextArea('text');
        $text->setLabel('Text');
        $this->add($text);

        $meta_title = new Text('meta_title', array('required' => true));
        $meta_title->setLabel('meta-title');
        $this->add($meta_title);

        $meta_description = new TextArea('meta_description');
        $meta_description->setLabel('meta-description');
        $this->add($meta_description);

        $meta_keywords = new TextArea('meta_keywords');
        $meta_keywords->setLabel('meta-keywords');
        $this->add($meta_keywords);

        $preview_inner = new Check('preview_inner');
        $preview_inner->setLabel('Show in the product');
        $preview_inner->setDefault(1);
        $this->add($preview_inner);

        $image = new File('image');
        $image->setLabel('Thumbnail Image');
        $this->add($image);
    }

} 