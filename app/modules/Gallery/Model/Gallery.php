<?php
/**
 * Created by PhpStorm.
 * User: office-pb1
 * Date: 07.07.14
 * Time: 22:27
 */

namespace Gallery\Model;

use Application\Mvc\Model;

class Gallery extends Model
{

    public function getSource()
    {
        return "gallery";
    }

    public $id;
    public $title;
    public $animation_speed = 300;
    public $delay = 5;
    public $visible;

    public function initialize()
    {
        $this->hasMany('id', 'Gallery\Model\GalleryImage', 'gallery_id', array(
            'alias' => 'GalleryImages'
        ));

    }

    public function afterCreate()
    {

    }

    public function afterUpdate()
    {
        $cache = $this->getDi()->get('cache');

        $query = "id = {$this->id} AND visible = 1";
        $key = HOST_HASH . md5("Gallery::findCachedById($query)");
        $cache->delete($key);

        $key = HOST_HASH . md5("Gallery::cachedImages({$this->id})");
        $cache->delete($key);
    }


    public function beforeValidation()
    {
        $this->setVisible((isset($_POST['visible'])) ? 1 : 0);
    }

    public function afterValidation()
    {

    }

    public function afterValidationOnCreate()
    {

    }

    public static function findCachedById($id)
    {
        $query = "id = {$id} AND visible = 1";
        $key = HOST_HASH . md5("Gallery::findCachedById($query)");
        $gallery = self::findFirst(array(
            $query,
            'cache' => array(
                'key' => $key,
                'lifetime' => 60,
            )
        ));
        return $gallery;
    }

    public function cachedImages()
    {
        $query = "gallery_id = {$this->id}";
        $key = HOST_HASH . md5("Gallery::cachedImages({$this->id})");
        $images = GalleryImage::find(array(
            $query,
            'order' => 'sortorder ASC',
            'cache' => array(
                'key' => $key,
                'lifetime' => 60,
            )
        ));
        return $images;	
    }

	public function beforeSave()
    {
        if (empty ($this->animation_speed)){
            $this->animation_speed = 300;
        }

        if (empty ($this->delay)){
            $this->delay = 5;
        }
    }

    /**
     * @param int $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return int
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $animation_speed
     */
    public function setAnimationSpeed($animation_speed)
    {
        $this->animation_speed = $animation_speed;
    }

    /**
     * @return mixed
     */
    public function getAnimationSpeed()
    {
        return $this->animation_speed;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $delay
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    /**
     * @return mixed
     */
    public function getDelay()
    {
        return $this->delay;
    }

    public function getFirstImageId()
    {
        $images = $this->getRelated('GalleryImages');
        if (!empty($images) && isset($images[0])) {
            $image = $images[0];
            return $image->getId();
        }
    }

}
