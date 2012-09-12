<?php
/**
 * Input gear
 *
 * @author		Dmitriy Belyaev <admin@cogear.ru>
 * @copyright		Copyright (c) 2012, Dmitriy Belyaev
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage
 * @version		$Id$
 */
class Input_Gear extends Gear {

    protected $name = 'Input';
    protected $description = 'Catch user input';
    protected $order = -998;
    protected $get = array();
    protected $post = array();
    protected $cookies = array();


    /**
     * Init
     */
    public function init(){
        parent::init();
        $this->get = new Core_ArrayObject($_GET);
        $this->post = new Core_ArrayObject($_POST);
        $this->cookies = new Core_ArrayObject($_COOKIE);
    }

    /**
     * Get method
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name = '',$default = NULL){
        if(!$name) return $this->get;
        if(isset($this->get->$name)){
            /**
             * Important. Wrap value into object to get it through event.
             */
            $get = new Core_ArrayObject();
            $get->value = $this->get->$name;
            event('input.get',$get);
            return $get->value;
        }
        else {
            return $default;
        }
    }
    /**
     * Post method
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function post($name = '',$default = NULL){
        if(!$name) return $this->post;
        return isset($this->post[$name]) ? $this->post[$name] : $default;
    }
    /**
     * Cookie method
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function cookie($name = '',$default = NULL){
        if(!$name) return $this->cookie;
        return isset($this->cookie[$name]) ? $this->cookie[$name] : $default;
    }
}