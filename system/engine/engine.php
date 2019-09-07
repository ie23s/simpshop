<?php
namespace ie23s\simpshop\system\engine;
use ie23s\simpshop\main\Main;

require_once __ROOT__.'/system/engine/modules.php';
class Engine {
    private $path;
    public function __construct() {
       $path = $_GET['do'];
       if(Main::$init->hasPath($path)){
           //...
       } else {
           //Display 404!
       }
    }
}