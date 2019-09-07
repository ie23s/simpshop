<?php
namespace ie23s\simpshop\modules\Display\module;

class Display
{
    private $display = "";
    private $path = "";
    private $theme = "";
    static $display_class;
    
    public function __construct() {
        self::$display_class = $this;
    }
    
    public function loadTpl($name) {
        //echo $this->path . '/' . $this->theme . '/' . $name.'.tpl';
        $content = file_get_contents($this->path . '/' . $this->theme . '/' . $name.'.tpl');
        $content = Expressions::includeTpls($content);
        return $content;
        
    }
    
    public function loadUserInterface($path, $theme) {
        $this->path = $path;
        $this->theme = $theme;
        $this->display = $this->loadTpl('main');
        $this->addVar('title', 'jkhudsj');
        
    }
    
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
    
    public function display() {
        $this->display = Expressions::replaceVars($this->display);
        $this->display = Expressions::_if($this->display);
        print($this->display);
    }
}
