<?php

/**
 * Abstract widget
 *
 * @author		Dmitriy Belyaev <admin@cogear.ru>
 * @copyright		Copyright (c) 2012, Dmitriy Belyaev
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage
 * @version		$Id$
 */
class Widgets_Widget extends Options {//Db_Item {

//    protected $table = 'widgets';
//    protected $primary = 'id';
//    protected $defaults = array(
//        'class' => 'well',
//    );
    public $options = array(
        'render' => 'sidebar',
        'class' => 'well',
        'order' => 0,
    );
    protected $template = 'Widgets.widget';
    public $code = '';

    /**
     * Construcotr
     */
//    public function __construct() {
//        parent::__construct();
//        $this->defaults = Core_ArrayObject::transform($this->defaults);
//    }

    /**
     * Overriding parent find method
     *
     * @return   mixed
     */
//    public function find() {
//        if ($result = parent::find()) {
//            $this->settings = unserialize($this->settings);
//            $this->mixer();
//            if ($this->object->class && class_exists($this->object->class)) {
//                $object = new $this->object->class();
//                $object->attach($result);
//                $this->attach($object);
//                return $object;
//            }
//        }
//        return $result;
//    }

    /**
     * Mix settings with defaults
     */
//    public function mixer() {
//        $this->settings = $this->defaults->mix($this->settings);
//    }

    /**
     * Override parent findAll method
     *
     * @return  mixed
     */
//    public function findAll() {
//        if ($result = parent::findAll()) {
//            foreach ($result as $key => $value) {
//                if (class_exists($value->object->class)) {
//                    $item = new $value->object->class();
//                    $item->attach($value);
//                    $result->$key = $item;
//                } else {
//                    $result->offsetUnset($key);
//                }
//            }
//            foreach ($result as $item) {
//                if ($item->settings) {
//                    $item->settings = unserialize($item->settings);
//                    $item->mixer();
//                }
//            }
//        }
//        return $result;
//    }

    /**
     * Override parent getData method
     *
     * @return arrau
     */
//    public function getData() {
//        if ($data = parent::getData()) {
//            if (isset($data['settings'])) {
//                $data['settings'] = serialize($data['settings']);
//            }
//            $data['class'] = $this->reflection->getName();
//        }
//        return $data;
//    }

    /**
     * Return info about widget
     *
     * @return array
     */
//    public static function info(){
//        return array(
//            'name' => '',
//            'description' => '',
//            'logo' => '',
//            'package' => 'system',
//        );
//    }
    /**
     * Render
     *
     * @return type
     */
    public function render(){
        return template($this->template,array('code'=>$this->code,'options'=>$this->options,'item'=>$this))->render();
    }

    /**
     * Show widget
     */
    public function show($region = NULL,$position = 0, $where = 0){
        if(!$region) $region = $this->options->render;
        return parent::show($region,$position,$where);
    }
}