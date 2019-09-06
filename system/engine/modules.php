<?php
namespace ie23s\simpshop\system\engine;
use ie23s\simpshop\main as main;

class Modules {
    
    public $modules = array();
    public $first_unload_modules = array();
    public $second_unload_modules = array();
    public $modules_path = array();
    public $configurations = array();
    
    
    public function loadModule($name) {
        if(isset($this->modules[$name])) return;
        require_once main\Main::$__DIR . '/modules/'. $name . "/main.php";
        $class = 'ie23s\simpshop\modules\\'.$name.'\Main';
        $this->modules[$name] = new $class;
        $this->config[$name] = new $this->modules[$name]->config;
        
        foreach ($this->config[$name]->required_modules as $module)
            $this->loadModule($module);
            $this->modules[$name]->load();
            
            if($this->config[$name]->unload_priority == 1) {
                $this->first_unload_modules[]  = $this->modules[$name];
            } elseif ($this->config[$name]->unload_priority == 2) {
                $this->second_unload_modules[]  = $this->modules[$name];
            }
            if($this->config[$name]->has_pages) {
                $this->modules_path[]  = $this->modules[$name];
            }
    }
    
    public function hasPath($param) {
        foreach ($this->modules_path as $module) {
            if($module->hasPath())
                return $module;
        }
        return NULL;
    }
    
    public function unloadModules() {
        for($i = count($this->first_unload_modules)-1; $i >= 0; $i--)
            $this->first_unload_modules[$i]->unload();
            for($i = count($this->second_unload_modules)-1; $i >= 0; $i--)
                $this->second_unload_modules[$i]->unload();
    }
}