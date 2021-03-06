<?php

/**
 * Шестеренка для управления подключаемыми JS и CSS файлами
 *
 * @author		Беляев Дмитрий <admin@cogear.ru>
 * @copyright		Copyright (c) 2012, Беляев Дмитрий
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 */
class Assets_Gear extends Gear {

    public $js;
    public $css;
    protected static $is_init;

    /**
     * Вывод глобальный переменных в заголовке
     */
    public function hookHead() {
        $cogear = new Core_ArrayObject();
        $cogear->settings = new Core_ArrayObject();
        $cogear->settings->site = SITE_URL;
        event('assets.js.global', $cogear);
        echo HTML::script("var cogear = cogear || " . json_encode($cogear).";\n
            window.cogear = cogear;",array(), TRUE);
    }

    /**
     * Конструктор
     */
    public function __construct($config) {
        parent::__construct($config);
        if(self::$is_init){
            return;
        }
        // Важно повесить хук именно таким образом, чтобы информация выводилась до остальных скриптов
        hook('head',array($this,'hookHead'));
        $this->js = Assets::factory('scripts', config('assets.js'));
        $this->css = Assets::factory('styles', config('assets.css'));
        self::$is_init = TRUE;
    }
    /**
     * Инициализацтор
     */
    public function init(){
        hook('head',array($this->js,'output'));
        hook('head',array($this->css,'output'));
        parent::init();
    }
}

/**
 * Функции-ярлыки
 */
function css($url, $region = 'content') {
    append($region, HTML::style($url));
}

function js($url, $region = 'content') {
    append($region, HTML::script($url));
}

function inline_js($code, $region = 'content') {
    append($region, HTML::script($code, array(), TRUE));
}