<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Drivers;
use Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface;
use Reea\FileSearcher\Bundle\Iterators as I;
use Reea\FileSearcher\Bundle\Helpers\SortHelper;
/**
 * Description of DefaultDriver
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class DefaultDriver extends AbstractDriver implements DriverInterface{
    
    private static $id = "default";
    
    private $enabled = true;
    
    /**
     * {@inheritdoc}
     */
    public function search() {
        
        $iterator = new \RecursiveIteratorIterator(
            new I\RecursiveDirectoryIterator($this->path, $this->settings['skipUnreadable']),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        if(isset($this->settings['textIncluded']) && NULL !== $this->settings['textIncluded']){
            $iterator = new I\FileContentFilterIterator($iterator, $this->settings['textIncluded'], "");
        }
        
        if(isset($this->settings['filters']) && NULL !== $this->settings['filters']){
            $iterator = new I\FileExtensionIterator($iterator, $this->settings['filters']);
        }
        
        if(isset($this->settings['sort']) && NULL !== $this->settings['sort']){
            $iterator = new I\SorterIterator($iterator, $this->settings['sort']);
            $iterator = $iterator->getIterator();
        }
        
        echo "<pre>";
        var_dump($iterator);
        echo "</pre>";
        die(__LINE__ . __FILE__);
        
        return $iterator;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId() {
        return static::$id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isEnabled(){
        return $this->enabled;
    }
}
