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
        
        if(NULL !== $this->settings['textIncluded'] || NULL !== $this->settings['textExcluded']){
            $iterator = new I\FileContentFilterIterator($iterator, $this->settings['textIncluded'], $this->settings['textExcluded']);
        }
        
        if(NULL !== $this->settings['ignoredFolders']){
            $iterator = new I\IgnoredFoldersIterator($iterator, $this->settings['ignoredFolders']);
        }
        
        if(NULL !== $this->settings['sort']){
            $iterator = new I\SorterIterator($iterator, $this->settings['sort']);
            $iterator = $iterator->getIterator();
        }
        
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
