<?php
namespace ie23s\simpshop\modules\Display\module;

class Expressions
{
    private static $conditions = array();
    private static $variables = array();
    
    public static function _if($content) {
        preg_match_all('/\{if (.*)\=(.*)\}(.*)\{else\}(.*)\{\/if\}/s', $content, $matches);
        
        for ($i=0; $i< count($matches[0]); $i++) {
            if(self::$conditions[$matches[1][$i]] == $matches[2][$i])
                $content = str_replace($matches[0][$i], $matches[3][$i], $content);
                else
                    $content = str_replace($matches[0][$i], $matches[4][$i], $content);
        }
        return $content;
        
    }
    public static function includeTpls($content) {
        preg_match_all('/\{file\=(.*)\}/', $content, $matches);
        for ($i=0; $i< count($matches[0]); $i++) {
            $file = Display::$display_class->loadTpl($matches[1][$i]);
            $content = str_replace($matches[0][$i], $file, $content);
        }
    }
    public static function addCondition($name, $value) {
        self::$conditions[$name] = $value;
    }
    public static function addVar($name, $value) {
        self::$variables[$name] = $value;
    }
    public static function replaceVars($content) {
        
        //Replacing created variables
        foreach (self::$variables as $name => $value)
            $content = str_replace('{' . $name . '}', $value, $content);
        self::$variables = array();
        return $content;
    }
}