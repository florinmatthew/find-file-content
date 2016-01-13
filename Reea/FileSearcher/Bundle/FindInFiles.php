<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle;
use Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface;
use Reea\FileSearcher\Bundle\Drivers\DefaultDriver;
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
     * Get driver by name
     * @param String $name
     * @return Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface
     */
    public function getDriver($name){
        return $this->driver[$name];
    }
    
    /**
     * Append driver to the list of drivers.
     * @param Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface $driver
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function appendDriver(DriverInterface $driver){
        $this->driver[$driver->getId()] = $driver;
        
        return $this;
    }
}
