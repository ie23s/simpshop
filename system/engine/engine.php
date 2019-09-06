<?php
use ie23s\simpshop\main\Main;

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