<?php

/**
 *
 *
 * @author		Беляев Дмитрий <admin@cogear.ru>
 * @copyright		Copyright (c) 2012, Беляев Дмитрий
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage

 */
class Blog_Widget extends Widgets_Widget {

    public $options = array(
        'class' => 'well blog-widget',
        'limit' => 5,
        'render' => 'sidebar',
        'order' => 1,
        'cache_ttl' => 3600,
    );
    protected $template = 'Widgets/templates/widget';

    /**
     * Render
     */
    public function render() {
        // @todo Find a bug with db to avoid the next stoke
        cogear()->db->clear(); // Show be deleted
        $blogs = blog();
        $blogs->order('rating', 'desc');
        $blogs->limit($this->options->limit);
        if ($result = $blogs->findAll()) {
            $tpl = new Template('Blog/templates/widget');
            $tpl->blogs = $result;
            $this->code = $tpl->render();
        }
        return parent::render();
    }

}