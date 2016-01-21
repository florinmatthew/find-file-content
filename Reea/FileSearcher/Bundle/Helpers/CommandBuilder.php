<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Helpers;

/**
 * Description of Command
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class CommandBuilder {
    
    /**
     * @var Array 
     */
    protected $command = [];
    
    private static $modes = [
        1 => '-type f', 2 => '-type d'
    ];
    
    /**
     * 
     * @param type $path
     * @return \Reea\FileSearcher\Bundle\Helpers\CommandBuilder
     */
    public function create($path){
        $this->push('find')
                ->push($path)
                ->push('-noleaf');
        
        return $this;
    }
    
    /**
     * 
     * @param type $int
     * @return \Reea\FileSearcher\Bundle\Helpers\CommandBuilder
     */
    public function addMode($int){
        $this->push(self::$modes[$int]);
        return $this;
    }


    /**
     * 
     * @param type $string
     * @return \Reea\FileSearcher\Bundle\Helpers\CommandBuilder
     */
    public function push($string){
        $this->command[] = $string;
        
        return $this;
    }
    
    public function getCommandString(){
        return $this->command;
    }
    
}
