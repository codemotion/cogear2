<?php
/**
 * Abstract form element show condition class
 *
 * @author		Беляев Дмитрий <admin@cogear.ru>
 * @copyright		Copyright (c) 2011, Беляев Дмитрий
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage	Form

 */
abstract class Form_Condition_Abstract {
	/**
	 * Form
	 *
	 * @object
	 */
	protected $form;
        /**
         * Options
         *
         * @array
         */
        protected $options;
        /**
         * Element
         *
         * @var Form_Element_Abstract
         */
        public $element;
        /**
	 * Конструктор
	 *
	 * @param	object	$form
	 */
	public function __construct($options = array()){
                $this->options = $options;
                $cogear = getInstance();
		$this->form = $cogear->form->getForm();
	}
	/**
	 * Check
	 *
	 * @return	boolean
	 */
	abstract function check(); 
} 