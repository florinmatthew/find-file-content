<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Registry;
/**
 * Description of Drivers
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class Drivers {
    
    private $drivers = [
        'Reea\\FileSearcher\\Bundle\\Drivers\\DefaultDriver',
        'Reea\\FileSearcher\\Bundle\\Drivers\\GnuCommandDriver'
    ];
    
    /**
     * Get enabled drivers.
     * @return array
     * @throws Reea\FileSearcher\Bundle\Exceptions\InvalidDriverType
     */
    public function getEnabled(){
        $collection = [];
        foreach ($this->drivers as $ns){
            $driver = new $ns();
            
            if(!$driver instanceof \Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface){
                throw new \Reea\FileSearcher\Bundle\Exceptions\InvalidDriverType();
            }
            
            if($driver->isEnabled()){
                array_push($collection, $driver);
            }
        }
        
        return $collection;
    }
    
}
