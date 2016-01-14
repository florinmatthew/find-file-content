<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle;
use Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface;
use Reea\FileSearcher\Bundle\Drivers\DefaultDriver;
use Reea\FileSearcher\Bundle\Helpers\SearchSettings;
/**
 * Description of FindFile
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class FindInFiles {
    /**
     * @var type 
     */
    protected $drivers = [];
    
    /**
     * @var type 
     */
    protected $walker;
    
    private $result;
    
    /**
     * @var String 
     */
    private $path;
    
    /**
     * @var Array
     */
    private $textIncluded;
    
    protected static $excludedFolders = ['.git', '.svn', 'nbproject'];
            
    function __construct() {
        $this->appendDriver(new DefaultDriver());
    }
    
    /**
     * Get drivers by name or the entire list of drivers.
     * @param string $name
     * @return mixed
     */
    public function getDrivers($name = ""){
        
        if("" != $name){
            return $this->drivers[$name];
        }else{
            return $this->drivers;
        }
        
    }
    
    /**
     * Append driver to the list of drivers.
     * @param Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface $driver
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function appendDriver(DriverInterface $driver){
        $this->drivers[$driver->getId()] = $driver;
        
        return $this;
    }
    
    /**
     * Make the driver
     * @param DriverInterface $driver
     * @return DriverInterface
     */
    protected function makeDriver(DriverInterface $driver){
        $newDriver = $driver->appendSettings($settings);
        
        return $newDriver;
    }
    
    /**
     * 
     * @param type $path
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setPath($path){
        $this->path = $path;
        
        return $this;
    }
    
    /**
     * 
     * @param array $textIncluded
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setTextIncluded(array $textIncluded) {
        $this->textIncluded = $textIncluded;
        
        return $this;
    }


    public function startSearch(){
        echo 'search started';
    }
    
    public function asJson(){
        
    }
    
}
