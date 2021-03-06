<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Drivers;
use Reea\FileSearcher\Bundle\Helpers\SearchSettings;
/**
 * Description of AbstractDriver
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AbstractDriver {
    
    /**
     * @var String 
     */
    protected $path;
    
    /**
     * @var Array 
     */
    protected $settings = array();
    
    /**
     * Set search path.
     * @param type $path
     * @return \Reea\FileSearcher\Bundle\Drivers\AbstractDriver
     */
    public function setPath($path){
        $this->path = $path;
        
        return $this;
    }
    
    /**
     * Append search settings
     */
    public function appendSettings(array $settings){
        if(SearchSettings::validate($settings)){
            $this->settings = $settings;
        }
        
        return $this;
    }
    
    /**
     * Clear settings array.
     */
    public function clearSettings(){
        unset($this->settings);
        $this->settings = array();
    }
    
}
