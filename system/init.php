<?php
/***
 * Initialisation configurations, modules, databases, and other components of system.
 */

namespace ie23s\simpshop\system;
use ie23s\simpshop\main as main;
use ie23s\simpshop\configuration\main\Config;

require_once __DIR__.'/config.php';

class Init {
    public $configurations = array();
    public $modules = array();
    
    function __construct() {
        $this->configurations['main'] = new Config();
        foreach ($this->configurations['main']->modules as $module)
            $this->loadModule($module);
        $this->modules['Error']->module->addError("Initialisation...", "While loading module ". ";lkjhgfdsa", "kjhgfdsa", 1);
    }
    
    public function loadModule($name) {
            if(isset($this->modules[$name])) return;
            require_once main\Main::$__DIR . '/modules/'. $name . "/main.php";
            $class = 'ie23s\simpshop\modules\Main_'.$name;
            $this->modules[$name] = new $class;
            $this->config[$name] = new $this->modules[$name]->config;
            
            foreach ($this->config[$name]->required_modules as $module)
                $this->loadModule($module);
            $this->modules[$name]->load();
    }
}