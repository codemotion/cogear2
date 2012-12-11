<?php

/**
 * Sessions adapter file
 *
 * @author		Беляев Дмитрий <admin@cogear.ru>
 * @copyright		Copyright (c) 2011, Беляев Дмитрий
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 *         Session

 */
class Session_Adapter_File extends Cache_Adapter_File {
    protected $name;
    /**
     * Session open
     * 
     * @return boolean 
     */
    public function open($save_path,$session_name){
        $this->name = $session_name;
        return TRUE;
    }
    /**
     * Destroy
     * 
     * @param string  $id 
     */
    public function destroy($id){
        $this->remove($id);
    }
    /**
     * Session close
     * 
     * @return boolean 
     */
    public function close(){
        return TRUE;
    }
    /**
     * Session garbage collector
     *
     * @param int $ttl
     */
    public function gc($ttl) {
        $dir = new DirectoryIterator($this->path);
        foreach ($dir as $file) {
            if (!$file->isDot() && $file->getMTime() + $ttl < time()) {
                @unlink($file->getPathname());
            }
        }
    }

}