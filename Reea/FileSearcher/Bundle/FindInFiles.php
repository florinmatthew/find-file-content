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
     *
     * @var type 
     */
    protected $drivers = [];
    
    /**
     *
     * @var type 
     */
    protected $walker;
    
    protected $directories = [];
    
    protected $ignoredFiles = [];
    
    protected $locations = [];
    
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
     * 
     * @param DriverInterface $driver
     */
    protected function makeDriver(DriverInterface $driver){
        //build driver with settings
    }
    
    public function setSettings(array $settings){
        SearchSettings::validate($settings);
    }
}
