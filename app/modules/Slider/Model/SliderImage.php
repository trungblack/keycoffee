<?php
/**
 * Created by PhpStorm.
 * User: office-pb1
 * Date: 07.07.14
 * Time: 22:27
 */

namespace Slider\Model;

use Application\Mvc\Model;

class SliderImage extends Model
{

    public function getSource()
    {
        return "slider_image";
    }

    protected $translateModel = 'Slider\Model\Translate\SliderTranslate';

    public $id;
    public $slider_id;
    public $caption;
    public $link;
    public $sortorder;

    public function initialize()
    {
        $this->belongsTo("slider_id", "Slider\Model\Slider", "id", array(
            'alias' => 'Slider'
        ));

        $this->hasMany("id", $this->translateModel, "foreign_id");

    }

    public function afterUpdate()
    {
        $cache = $this->getDi()->get('cache');
        $query = 'foreign_id = ' . $this->id . ' AND lang = "' . LANG . '"'; //for \Application\Mvc\Model->getTranslations();
        $transKey = HOST_HASH . md5('slider_image_translate ' . $query);
        $cache->delete($transKey);
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
     * @param mixed $slider_id
     */
    public function setSliderId($slider_id)
    {
        $this->slider_id = $slider_id;
    }

    /**
     * @return mixed
     */
    public function getSliderId()
    {
        return $this->slider_id;
    }

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->getMLVariable('caption');
    }

    /**
     * @param mixed $caption
     */
    public function setCaption($caption)
    {
        $this->setMLVariable('caption', $caption);
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->getMLVariable('link');
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->setMLVariable('link', $link);
    }

    /**
     * @param mixed $sortorder
     */
    public function setSortOrder($sortorder)
    {
        $this->sortorder = $sortorder;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sortorder;
    }

} 