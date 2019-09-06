<?php

namespace ie23s\simpshop\modules\MySQL_PDO;

class Config {
    public $name = 'MySQL_PDO';
    public $required_modules = array();
    public $unload_priority = 0;
    public $has_pages = FALSE;
    
    public $dbhost = '';
    public $dbport = '';
    public $dbname = '';
    public $dbuser = '';
    public $dbpass = '';
}