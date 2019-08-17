<?php 
/**
 * Index page which process query sent to server...
 */

namespace ie23s\simpshop\main;


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__.'/system/init.php';

use ie23s;

class Main {
    public static $__DIR;
    public static $init = NULL;
    private $path = 'main';
    
    function __construct() {
        if(isset($_GET['do']))
            $this->path = htmlspecialchars($_GET['do']);
    }
    
    public function load() {
        Main::$__DIR = __DIR__;
        Main::$init = new ie23s\simpshop\system\Init;
        
    }
    
}
$main = new Main();
$main->load();
Main::$init->unload();
print_r(Main::$init->configurations);