<?php

/**
 *  Markitup editor
 *
 * @author		Беляев Дмитрий <admin@cogear.ru>
 * @copyright		Copyright (c) 2012, Беляев Дмитрий
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage

 */
class Markitup_Editor extends Wysiwyg_Abstract {
    /**
     * Load scripts
     */
    public function load() {
        $this->toolbar = Core_ArrayObject::transform($this->toolbar);
        $folder = cogear()->markitup->folder . '/';
        css($folder . 'skins/simple/style.css');
        css($folder . 'sets/default/style.css');
        js($folder . 'js/jquery.markitup.js', 'after');
        event('markitup.toolbar', $this->toolbar);
//        $this->toolbar->markupSet->uasort('Core_ArrayObject::sortByOrder');
//            $(document).ready(function(){
        inline_js("
                                   $('[name=$this->name]').markItUp(" . json_encode($this->toolbar) . ")", 'after');
//                        }
    }

    public $toolbar = array(
        'nameSpace' => 'html',
        'onCtrlEnter' => array(
            'keepDefault' => FALSE,
            'openWith' => "\n<p>",
            'closeWith' => "</p>\n",
        ),
        'onTab' => array(
            'keepDefault' => false,
            'openWith' => '  ',
        ),
        'markupSet' => array(
            array(
                'name' => 'Bold',
                'key' => 'B',
                'openWith' => '<b>',
                'closeWith' => '</b>',
                'className' => 'markItUpBold',
            ),
            array(
                'name' => 'Italic',
                'key' => 'I',
                'openWith' => '<i>',
                'closeWith' => '</i>',
                'className' => 'markItUpItalic',
            ),
            array(
                'name' => 'Underlined',
                'key' => 'U',
                'openWith' => '<u>',
                'closeWith' => '</u>',
                'className' => 'markItUpUndeline',
            ),
            array(
                'name' => 'Strike through',
                'key' => 'S',
                'openWith' => '<s>',
                'closeWith' => '</s>',
                'className' => 'markItUpStrike',
            ),
            array(
                'name' => 'Heading 1',
                'key' => '1',
                'openWith' => '<h1>',
                'closeWith' => '</h1>',
                'className' => 'markItUpH1',
            ),
            array(
                'name' => 'Heading 2',
                'key' => '2',
                'openWith' => '<h2>',
                'closeWith' => '</h2>',
                'className' => 'markItUpH2',
            ),
            array(
                'name' => 'Heading 3',
                'key' => '3',
                'openWith' => '<h3>',
                'closeWith' => '</h3>',
                'className' => 'markItUpH3',
            ),
            array(
                'name' => 'UL',
                'multiline' => true,
                'openBlockWith' => "<ul>\n",
                'closeBlockWith' => "\n</ul>\n",
                'openWith' => " <li>",
                'closeWith' => "</li>",
                'className' => 'markItUpUl',
            ),
            array(
                'name' => 'OL',
                'multiline' => true,
                'openBlockWith' => "<ol>\n",
                'closeBlockWith' => "\n</ol>\n",
                'openWith' => " <li>",
                'closeWith' => "</li>",
                'className' => 'markItUpOl',
            ),
            array(
                'name' => 'Picture',
                'key' => 'P',
                'replaceWith' => '<img src="[![Source:!:http://]!]" alt="" />',
                'className' => 'markItUpPicture',
            ),
            array(
                'name' => 'Link',
                'key' => 'L',
                'openWith' => '<a href="[![Link:!:http://]!]">',
                'closeWith' => '</a>',
                'className' => 'markItUpLink',
            ),
            array(
                'name' => 'User',
                'key' => 'U',
                'openWith' => '[user=[![User]!]]',
                'className' => 'markItUpUser',
            ),
            array(
                'name' => 'Code',
                'key' => 'O',
                'openWith' => '<pre class="prettyprint linenums"><code>',
                'closeWith' => '</code></pre>',
                'className' => 'markItUpCode',
            ),
        )
    );

}
