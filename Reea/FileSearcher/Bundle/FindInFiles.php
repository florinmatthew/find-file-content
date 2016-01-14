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
    private $textIncluded = array();
    
    /**
     * @var Array
     */
    private $textExcluded = array();
    
    private $sort;
    
    /**
     * @var String 
     */
    private $matchRegex;
    
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
        $settings = [
            'textIncluded'  => $this->textIncluded,
            'textExcluded'  => $this->textExcluded,
            'sort'          => $this->sort,
            'matches_regex' => $this->matchRegex
        ];
        
        $newDriver = $driver->setPath($this->path)
                ->appendSettings($settings);
        
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
     * Set text to be included. Give me all files where these texts are present.
     * @param array $textIncluded
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setTextIncluded(array $textIncluded) {
        $this->textIncluded = $textIncluded;
        
        return $this;
    }
    
    /**
     * Set text to be excluded. (Give me all files where these texts are missing)
     * @param array $textExcluded
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setTextExcluded(array $textExcluded) {
        $this->textIncluded = $textExcluded;
        
        return $this;
    }
    
    public function sortMethod($param) {
        $this->sort = $param;
        
        return $this;
    }

    /**
     * Path matches regex.
     * @param String $regex
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setMatchesRegex($regex){
        $this->matchRegex = $regex;
        
        return $this;
    }


    public function startSearch(){
        foreach ($this->drivers as $driver){
            $newDriver = $this->makeDriver($driver);
            $newDriver->search();
        }
    }
    
    public function asJson(){
        
    }
    
}
