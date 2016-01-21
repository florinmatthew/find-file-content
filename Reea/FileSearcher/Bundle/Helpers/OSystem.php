<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Helpers;

/**
 * Check for OS
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class OSystem {
    
    static $DEFAULT_COMMAND = "which ";
    
    private static $os_names = [
        1 => 'linux', 2 => 'win', 3 => 'darwin', 4 => 'bsd'
    ];
    
    /**
     * Get OS
     * @return int 1 => 'linux', 2 => 'win', 3 => 'darwin', 4 => 'bsd'
     */
    public static function getType(){
        
        $system = strtolower(PHP_OS);

        foreach (self::$os_names as $key=>$name){
            if(false !== strpos($system, $name)){
                return $key;
            }
        }
        
        return 1;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getName($id){
        return self::$os_names[$id];
    }
    
    
    public function makeTest($command){
//        
        if (FALSE === function_exists('exec')) {
            return false;
        }

        $baseCommand = static::$DEFAULT_COMMAND;
        
        if ($this->getType() === 2) {
            $baseCommand = 'where ';
        }

        $command = escapeshellcmd($command);
        exec($baseCommand.$command, $output, $code);

        return 0 === $code && count($output) > 0;
    }
    
}
