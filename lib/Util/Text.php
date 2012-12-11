<?php

namespace Util;

class Text {

    public static function classNameOnly($class)
    {
        if (($pos = strrpos($class, "\\")) !== false)
            $class = substr($class, $pos+1);
        
        return $class;
    }
    
    public static function namespaceNameOnly($class)
    {
        if (($pos = strrpos($class, "\\")) !== false)
            $class = substr($class, 0, $pos);
        
        return $class;
    }
    
    public static function generateLabel($text)
    {
        return strtr(ucwords(str_replace('_', ' ', $text)), array(
            ' De ' => ' de ',
            ' Da ' => ' da ',
            ' Do ' => ' do ',
            ' Das ' => ' das ',
            ' Dos ' => ' dos ',
        ));
    }
    
    public static function sanitizeAttributeName($text)
    {
        return str_replace('-', '_', $text);
    }
    
}
