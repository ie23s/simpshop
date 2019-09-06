<?php
namespace ie23s\simpshop\modules\Display\module;

class Display
{
    private $display = "";
    private $path = "";
    private $theme = "";
    private $variables = array();
    private $conditions = array();
    
    public function loadTpl($name) {
        //echo $this->path . '/' . $this->theme . '/' . $name.'.tpl';
        $content = file_get_contents($this->path . '/' . $this->theme . '/' . $name.'.tpl');
        $this->addCondition('var', 'da');
        $content = $this->_if($content);
        return $content;
    }
    
    public function loadUserInterface($path, $theme) {
        $this->path = $path;
        $this->theme = $theme;
        $this->display = $this->loadTpl('main');
        $this->addVar('title', 'jkhudsj');
        
    }
    //Conditions part (needed a new class...)
    public function _if($content) {
        preg_match_all('/\{if (.*)\=(.*)\}(.*)\{else\}(.*)\{\/if\}/s', $content, $matches);
        
        for ($i=0; $i< count($matches[0]); $i++) {
            if($this->conditions[$matches[1][$i]] == $matches[2][$i])
                $content = str_replace($matches[0][$i], $matches[3][$i], $content);
            else
                $content = str_replace($matches[0][$i], $matches[4][$i], $content);
        }
        return $content;
        
    }
    function addCondition($name, $value) {
        $this->conditions[$name] = $value;
    }
    //\/Conditions part
    
    public function jsonResponse($response, $status = 0) {
        switch ($status) {
            case 0: $status = 'success';
            break;
            case 1: $status = 'error';
            break;
            case 2: $status = 'processing';
            break;
        }
        $this->display = json_encode(array('status' => $status, 'response' => $response));
    }
    
    public function addVar($name, $value) {
        $this->variables[$name] = $value;
    }
    public function display() {
        //Replacing created variables
        foreach ($this->variables as $name => $value)
            $this->display = str_replace('{' . $name . '}', $value, $this->display);
        print($this->display);
    }
}
