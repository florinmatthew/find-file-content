<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Helpers;

/**
 * Description of Sorter
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class SortHelper {
    
    /**
     * Sort by:
     * @var Array 
     */
    protected static $sorters = [
        1 => 'name', 2 => 'created', 3 => 'changed'
    ];
    
    /**
     * 
     * @return Array [1 => 'name', 2 => 'size', 3 => 'created']
     */
    public static function getSorters(){
        return static::$sorters;
    }
    
    /**
     * Get sorter int value by name.
     * @param String $name
     * @return mixed
     */
    public function getSorterVal($name){
        $sorter = array_flip(static::$sorters);
        
        if(array_key_exists($name, $sorter)){
            return $sorter[$name];
        }
        
        return false;
    }
    
    /**
     * Get callable.
     * @param Int $id
     * @return mixed
     */
    public static function getCallable($id){
        $method_name = "by" . ucfirst(static::$sorters[$id]);
        
        if(method_exists($this, $method_name)){ 
            return $method_name();
        }
        
        return false;
    }
    
    private function byName(){
        return function($a, $b){
            return strcmp($a->getRealpath(), $b->getRealpath());
        };
    }
    
    private function byCreated(){
        return function($a, $b){
            return ($a->getATime() - $b->getATime());
        };
    }
    
    private function byChanged(){
        return function($a, $b){
            return ($a->getCTime() - $b->getCTime());
        };
    }
    
}
