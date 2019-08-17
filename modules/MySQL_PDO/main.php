<?php 
/***
 * This is MySQL PDO module.
 */

namespace ie23s\simpshop\modules\MySQL_PDO;

use ie23s\simpshop\modules\MySQL_PDO\module\DB;
use ie23s\simpshop\modules\Module;

require_once __DIR__.'/config.php';
require_once __DIR__.'/module/PDO.class.php';

class Main implements Module{
    function __construct() {
        $this->config = new Config();
    }
    public function load() {
        $this->module = new DB($this->config->dbhost, 
            $this->config->dbport,
            $this->config->dbname,
            $this->config->dbuser,
            $this->config->dbpass);
    }
    public function loadDB($Host, $DBPort, $DBName, $DBUser, $DBPassword) {
        return new DB($Host, $DBPort, $DBName, $DBUser, $DBPassword);
    }
    public function unload()
    {}
}