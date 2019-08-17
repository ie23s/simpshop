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
    public $first_unload_modules = array();
    public $second_unload_modules = array();
    
    function __construct() {
        $this->configurations['main'] = new Config();
        foreach ($this->configurations['main']->modules as $module)
            $this->loadModule($module);
    }
    
    public function loadModule($name) {
            if(isset($this->modules[$name])) return;
            require_once main\Main::$__DIR . '/modules/'. $name . "/main.php";
            $class = 'ie23s\simpshop\modules\\'.$name.'\Main';
            $this->modules[$name] = new $class;
            $this->config[$name] = new $this->modules[$name]->config;
            
            foreach ($this->config[$name]->required_modules as $module)
                $this->loadModule($module);
            $this->modules[$name]->load();
            
            if($this->configurations[$name]->unload_priority == 1) {
                $this->first_unload_modules[]  = $this->modules[$name];
            } elseif ($this->configurations[$name]->unload_priority == 2) {
                $this->second_unload_modules[]  = $this->modules[$name];
            }
    }
    
    public function unload($module) {
        for($i = count($this->first_unload_modules); $i >= 0; $i--)
            $module->unload();
        for($i = count($this->second_unload_modules); $i >= 0; $i--)
            $module->unload();
    }
}