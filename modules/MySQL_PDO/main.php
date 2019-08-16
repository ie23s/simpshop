<?php 
/***
 * This is MySQL PDO module.
 */

namespace ie23s\simpshop\modules;

use ie23s\simpshop\modules\MySQL_PDO\module\DB;

require_once __DIR__.'/config.php';
require_once __DIR__.'/module/PDO.class.php';

class Main_MySQL_PDO {
    public $module;
    public $config;
    function __construct() {
        $this->config = new Config_MySQL_PDO();
    }
    function load() {
        $this->module = new DB($this->config->dbhost, 
            $this->config->dbport,
            $this->config->dbname,
            $this->config->dbuser,
            $this->config->dbpass);
    }
    function loadDB($Host, $DBPort, $DBName, $DBUser, $DBPassword) {
        return new DB($Host, $DBPort, $DBName, $DBUser, $DBPassword);
    }
}