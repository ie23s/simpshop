<?php
/***
 * Initialisation configurations, modules, databases, and other components of system.
 */

namespace ie23s\simpshop\system;
use ie23s\simpshop\configuration\main\Config;
use ie23s\simpshop\system\engine\Modules;

require_once __DIR__.'/config.php';
require_once __ROOT__.'/modules/module.php';

class Init {
    public $configuration;
    public $modules;
    
    function __construct() {
        $this->configuration = new Config();
        $this->modules = new Modules();
        foreach ($this->configuration->modules as $module)
            $this->modules->loadModule($module);
        
    }
    public function unload() {
        $this->modules->unloadModules();
    }
}