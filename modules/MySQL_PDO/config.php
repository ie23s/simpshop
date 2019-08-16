<?php

namespace ie23s\simpshop\modules;

class Config_MySQL_PDO {
    public const name = 'MySQL_PDO';
    public $required_modules = array();
    
    public $dbhost = '';
    public $dbport = '';
    public $dbname = '';
    public $dbuser = '';
    public $dbpass = '';
}