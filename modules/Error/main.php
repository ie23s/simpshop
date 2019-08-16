<?php 
/***
 * This is Error module.
 */

namespace ie23s\simpshop\modules;

use ie23s\simpshop\modules\Error\module\Error;

require_once __DIR__.'/config.php';
require_once __DIR__.'/module/Error.class.php';

class Main_Error {
    public $module;
    public $config;
    function __construct() {
        $this->config = new Config_Error();
    }
    function load() {
        $this->module = new Error();
    }
}