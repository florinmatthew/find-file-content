<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle;
use Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface;
use Reea\FileSearcher\Bundle\Drivers\DefaultDriver;
use Reea\FileSearcher\Bundle\Helpers\SortHelper;
use Reea\FileSearcher\Bundle\Registry\Drivers;
use Reea\FileSearcher\Bundle\Helpers\OSystem;
/**
 * Description of FindInFiles
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
    
    /**
     * @var type 
     */
    private $sort;
    
    /**
     * @var type 
     */
    private $filters = array();
    
    /**
     * @var String 
     */
    private $pattern;
    
    /**
     * @var bool 
     */
    private $skipUnreadable = 1;
    
    private $mode = 1;
    
    private static $modes = [
        1 => 'files', 2 => 'dirs'
    ];
    
    protected static $excludedFolders = ['.git', '.svn', 'nbproject'];

    function __construct() {
        /*Append registered drivers*/
        $drivers = new Drivers();
        $registered = $drivers->getEnabled();
        
        foreach ($registered as $driver){
            $this->appendDriver($driver);
        }
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
        
        if(array_key_exists($driver->getId(), $this->drivers)){
            throw new Reea\FileSearcher\Bundle\Exceptions\DuplicateDriverException();
        }
        $this->drivers[$driver->getId()] = $driver;
        
        return $this;
    }
    
    public function setMode($int){
        if(array_key_exists($int, self::$modes)){
            $this->mode = $int;
        }
        
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
            'sort'          => SortHelper::getSortVal($this->sort),
            'matches_regex' => $this->pattern,
            'filters'       => $this->filters,
            'ignoredFolders'=> $this->ignoredFolders,
            'skipUnreadable'=> $this->skipUnreadable,
            'mode'          => $this->mode
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
    
    public function getPath(){
        return $this->path;
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
    
    /**
     * 
     * @param String $param Values: 'name', 'created', 'changed' .
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function sortBy($param) {
        $this->sort = $param;
        
        return $this;
    }

    /**
     * File name pattern. Ex.: php, js, yml etc.
     * @param String $pattern
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setNamePattern($pattern){
        $this->pattern = $pattern;
        
        return $this;
    }
    
    /**
     * 
     * @param array $filters
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setFilters(array $filters) {
        $this->filters = $filters;
        
        return $this;
    }

    /**
     * 
     * @param array $ignored
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setIgnoredFolders(array $ignored) {
        $this->ignoredFolders = $ignored;
        
        return $this;
    }
    
    /**
     * Include unreadable folders in search.
     * @return \Reea\FileSearcher\Bundle\FindInFiles
     */
    public function setUnreadable(){
        $this->skipUnreadable = 0;
        
        return $this;
    }

    public function startSearch(){
        foreach ($this->drivers as $driver){
            $newDriver = $this->makeDriver($driver);
            
            $newDriver->search();
            
        }
        /*...*/
    }
    
}
