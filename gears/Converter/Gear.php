<?php

/**
 * Converter gear
 *
 * @author		Dmitriy Belyaev <admin@cogear.ru>
 * @copyright		Copyright (c) 2012, Dmitriy Belyaev
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage
 * @version		$Id$
 */
class Converter_Gear extends Gear {

    protected $name = 'Converter';
    protected $description = 'Converter description';
    protected $package = '';
    protected $order = 0;
    protected $hooks = array(
    );
    protected $routes = array(
    );
    protected $access = array(
    );
    public static $adapters = array(
        'Converter_Adapter_Cogear' => "Cogear v1",
    );
    protected $adapter;

    /**
     * Acccess
     *
     * @param string $rule
     * @param object $Item
     */
    public function access($rule, $Item = NULL) {
        switch ($rule) {
            case 'create':
                return TRUE;
                break;
        }
        return FALSE;
    }
    /**
     * Ignore assets autoload
     */
    public function loadAssets() {
        //parent::loadAssets();
    }
    /**
     * Hook menu
     *
     * @param string $name
     * @param object $menu
     */
    public function menu($name, $menu) {
        switch ($name) {
            case 'admin':
                $menu->register(array(
                    'label' => icon('refresh') . ' ' . t('Converter', 'Converter'),
                    'link' => l('/admin/converter/'),
                    'order' => 10000,
                ));
                break;
        }
    }

    /**
     *
     * @param type $action
     * @param type $subaction
     */
    public function admin($action = 'start', $subaction = NULL) {
        d('Converter');
        new Menu_Tabs(array(
                    'name' => 'converter',
                    'elements' => array(
                        'start' => array(
                            'label' => t('1. Start'),
                            'link' => '',
                            'active' => check_route('converter', Router::ENDS),
                        ),
                        'options' => array(
                            'label' => t('2. Options'),
                            'link' => '',
//                    'link' => l('/admin/converter/options'),
                            'active' => check_route('options', Router::ENDS),
                        ),
                        'process' => array(
                            'label' => t('3. Process'),
                            'link' => '',
//                    'link' => l('/admin/converter/process'),
                            'active' => check_route('process', Router::ENDS),
                        ),
                        'finish' => array(
                            'label' => t('4. Finish'),
                            'link' => '',
//                    'link' => l('/admin/converter/finish'),
                            'active' => check_route('finish', Router::ENDS),
                        ),
                        'clear' => array(
                            'label' => icon('remove') . ' ' . t('Reset'),
                            'class' => 'fl_r',
                            'link' => l('/admin/converter/clear'),
                        ),
                    ),
                ));
        if ($class = $this->session->get('converter.adapter')) {
            $this->adapter = new $class();
        }
        switch ($action) {
            case 'start':
                if(session('converter.adapter')){
                    redirect('/admin/converter/process/');
                }
                $form = new Form(array(
                            'name' => 'converter-adapter',
                            'elements' => array(
                                'adapter' => array(
                                    'label' => t('Choose to convert from'),
                                    'type' => 'select',
                                    'values' => self::$adapters,
                                ),
                                'actions' => array(
                                    'elements' => array(
                                        'submit' => array(
                                            'label' => t('Start!'),
                                        )
                                    )
                                )
                            )
                        ));
                if ($result = $form->result()) {
                    if ($result->adapter && class_exists($result->adapter)) {
                        $this->session->set('converter.adapter', $result->adapter);
                        redirect('/admin/converter/options/');
                    }
                }
                $form->show();
                break;
            case 'options':
                $form = new Form(array(
                            'name' => 'converter-options',
                            'elements' => array(
                                'database' => array(
                                    'label' => t('Database'),
                                    'type' => 'text',
                                    'placeholder' => 'mysql://username:password@host/database',
                                    'value' => 'mysql://root@localhost/cogear_one',
                                    'validators' => array('Required', 'Form_Validate_Url'),
                                ),
                                'actions' => array(
                                    'elements' => array(
                                        'submit' => array(
                                            'label' => t('Convert!'),
                                        )
                                    )
                                )
                            )
                        ));
                if ($result = $form->result()) {
                    if ($result->database) {
                        if ($config = Db::parseDSN($result->database)) {
                            $this->adapter->save($config);
                            redirect('/admin/converter/process');
                        }
                    }
                }
                $form->show();
                break;
            case 'process':
                template('Converter.process',array('steps'=>$this->adapter->getSteps()))->show();
                js($this->folder.'/js/converter.js');
                css($this->folder.'/css/converter.css');
                break;
            case 'finish':
                template('Converter.finish')->show();
                break;
            case 'adapter':
                if($subaction && method_exists($this->adapter, $subaction)){
                    $ajax = new Ajax();
                    $this->adapter->$subaction($ajax);
                    $ajax->json();
                }
                break;
            case 'clear':
                flash_success(t('Converter has been reset!'));
                $this->session->remove('converter.adapter');
                $this->session->remove('converter.options');
                $this->session->remove('converter.result');
                $this->session->remove('converter.step');
                $this->adapter && $this->adapter->clear();
                redirect('/admin/converter');
                break;
        }
        d();
    }

}