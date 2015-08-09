<?php

namespace Product\Model;

use Application\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Application\Localization\Transliterator;

class Product extends Model
{

    public function getSource()
    {
        return "product";
    }

    protected $translateModel = 'Product\Model\Translate\ProductTranslate'; // translate

    public function initialize()
    {
        $this->hasMany('id', $this->translateModel, 'foreign_id'); // translate

        $this->belongsTo('type_id', 'Product\Model\Type', 'id', array(
            'alias' => 'type'
        ));
    }

    public $id;
    public $type_id;
    public $title;
    public $gallery_id;
    public $slug;
    public $short_description;
    public $text;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $created_at;
    public $updated_at;
    public $date;
    public $preview_inner;

    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public function afterUpdate()
    {
        parent::afterUpdate();

        $cache = $this->getDi()->get('cache');

        $cache->delete(self::cacheSlugKey($this->getSlug()));
    }

    public function beforeValidation()
    {
        if ($_POST['form']) {
            $this->preview_inner = (isset($_POST['preview_inner'])) ? 1 : 0;
        }
    }

    public function validation()
    {
        $this->validate(new Uniqueness(
            array(
                "field" => "slug",
                "message" => "Страница с такой транслитерацией = '".$this->slug."' уже существует"
            )
        ));

        return $this->validationHasFailed() != true;
    }

    public function afterValidation()
    {
        if (!$this->date) {
            $this->date = date("Y-m-d H:i:s");
        }
    }

    public function updateFields($data)
    {
        if (!$this->getSlug()) {
            $this->setSlug(Transliterator::slugify($data['title']));
        }
        if (!$this->getMeta_title()) {
            $this->setMeta_title($data['title']);
        }
    }

    public static function findCachedBySlug($slug)
    {
        $product = self::findFirst(array("slug = '$slug'",
            'cache' => array(
                'key' => self::cacheSlugKey($slug),
                'lifetime' => 60)
        ));
        return $product;
    }

    public static function cacheSlugKey($slug)
    {
        $key = HOST_HASH . md5('Product\Model\Product; slug = ' . $slug);
        return $key;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setGallery_id($id)
    {
        $this->gallery_id = $id;
    }

    public function getGallery_id()
    {
        return $this->gallery_id;
    }

    public function setPrice($price)
    {
        $this->setMLVariable('price', $price);
    }

    public function getPrice()
    {
        return $this->getMLVariable('price');
    }

    public function setPackage($package)
    {
        $this->setMLVariable('package', $package);
    }

    public function getPackage()
    {
        return $this->getMLVariable('package');
    }

    public function setShort_description($short_description)
    {
        $this->setMLVariable('short_description', $short_description);
    }

    public function getShort_description()
    {
        return $this->getMLVariable('short_description');
    }

    public function setMeta_description($meta_description)
    {
        $this->setMLVariable('meta_description', $meta_description);
    }

    public function getMeta_description()
    {
        return $this->getMLVariable('meta_description');
    }

    public function setMeta_keywords($meta_keywords)
    {
        $this->setMLVariable('meta_keywords', $meta_keywords);
    }

    public function getMeta_keywords()
    {
        return $this->getMLVariable('meta_keywords');
    }

    public function setMeta_title($meta_title)
    {
        $this->setMLVariable('meta_title', $meta_title);
    }

    public function getMeta_title()
    {
        return $this->getMLVariable('meta_title');
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setText($text)
    {
        $this->setMLVariable('text', $text);
    }

    public function getText()
    {
        return $this->getMLVariable('text');
    }

    public function setTitle($title)
    {
        $this->setMLVariable('title', $title);
    }

    public function getTitle()
    {
        return $this->getMLVariable('title');
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setDate($date)
    {
        $this->date = date("Y-m-d H:i:s",strtotime($date));
    }

    public function getDate($format = 'Y-m-d')
    {
        if ($format) {
            return date($format, strtotime($this->date));
        } else {
            return $this->date;
        }
    }

    /**
     * @param mixed $type_id
     */
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;
    }

    /**
     * @return mixed
     */
    public function getType_id()
    {
        return $this->type_id;
    }

    public function getTypeTitle()
    {
        if ($this->type_id) {
            $types = Type::cachedListArray(array('key' => 'id'));
            if (array_key_exists($this->type_id, $types)) {
                return $types[$this->type_id];
            }
        }
    }

    public function getTypeSlug()
    {
        if ($this->type_id) {
            $types = Type::cachedListArray(array('key' => 'id', 'value' => 'slug'));
            if (array_key_exists($this->type_id, $types)) {
                return $types[$this->type_id];
            }
        }
    }

    /**
     * @param mixed $preview_inner
     */
    public function setPreviewInner($preview_inner)
    {
        $this->preview_inner = $preview_inner;
    }

    /**
     * @return mixed
     */
    public function getPreviewInner()
    {
        return $this->preview_inner;
    }

}