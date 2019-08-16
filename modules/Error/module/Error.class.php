<?php
namespace ie23s\simpshop\modules\Error\module;

class Error
{
    public $error = array();
    
    public function addError($module, $text, $log, $level = 0) {
        echo 'lol';
        $this->error[] = array($module, $text, $log, $level);
        if($level === 1)
            die($this->showErrors());
    }
    
    public function showErrors() {
        $string = "";
        foreach ($this->error as $key => $val) {
            $string .= ($key + 1)." ".$val[0].": ".$val[1]."(".$val[3].")\r\n".$val[2]."\r\n";
        }
        return $string;
    }
}
