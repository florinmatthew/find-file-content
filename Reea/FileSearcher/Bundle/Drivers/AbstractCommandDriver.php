<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Drivers;
use Reea\FileSearcher\Bundle\Helpers\OSystem;
use Reea\FileSearcher\Bundle\Helpers\CommandBuilder;
use Reea\FileSearcher\Bundle\Helpers\SortHelper;
/**
 * Description of AbstractCommandDriver
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AbstractCommandDriver extends AbstractDriver{
    
    protected $o_systems;
    
    protected $builder;
            
    function __construct() {
        $this->o_systems = new OSystem();
        $this->builder = new CommandBuilder();
    }
    
    public function search(){
        
        $this->builder->create($this->path);
        $this->builder->addMode($this->settings['mode']);
        if(isset($this->settings['sort']) && $this->settings['sort'] !== NULL){
            $this->sort($this->builder, $this->settings['sort']);
        }
        $this->makeIncludedText($this->builder, $this->settings['textIncluded']);
        
        $command = implode(" ", $this->builder->getCommandString());
        echo $command."<br />";
        exec($command, $out, $var);
        
        echo "<pre>";
        var_dump($out);
        echo "</pre>";
        die(__LINE__ . __FILE__);
        
        $this->o_systems->makeTest('find');
    }
    
    /**
     * 
     * @param CommandBuilder $builder
     * @param type $included
     */
    protected function makeIncludedText(CommandBuilder $builder, $included){
        $builder->push('| xargs grep -r "'.$included.'"');
    }
    
    abstract function sort(CommandBuilder $builder, $sort);
    
}
