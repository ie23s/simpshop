<?php
namespace ie23s\simpshop\modules;

interface Module {
    public $module;
    public $config;
    
    public function load();
    public function unload();
} 
