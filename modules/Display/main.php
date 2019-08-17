<?php 
/***
 * This is Error module.
 */

namespace ie23s\simpshop\modules\display;

use ie23s\simpshop\modules\Module;
use ie23s\simpshop\modules\Display\module\Display;

require_once __DIR__.'/config.php';
require_once __DIR__.'/module/Display.class.php';

class Main implements Module {
    function __construct() {
        $this->config = new Config();
    }
    function load() {
        $this->module = new Display();
    }
    public function unload()
    {}

}