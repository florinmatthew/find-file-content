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
     * Comamnd based sort.
     * @var type 
     */
    protected static $gnuSort = [
        1 => '| sort', 2 => '%A@ %h/%f\\n', 3 => '%C@ %h/%f\\n'
    ];
    
    /**
     * Get sorter int value by name.
     * @param String $name
     * @return mixed
     */
    public static function getSortVal($name){
        $sorter = array_flip(static::$sorters);
        
        if(! array_key_exists($name, $sorter)){
            throw new Reea\FileSearcher\Bundle\Exceptions\InvalidSortArgumentException();
        }
        
        return $sorter[$name];
    }
    
    /**
     * Get callable.
     * @param Int $id
     * @return mixed Return callable function. FALSE if callable does not exists
     */
    public static function getCallable($id){
        $method_name = "by" . ucfirst(static::$sorters[$id]);
        
        if(method_exists(self::class, $method_name)){ 
            return self::{$method_name}();
        }
        
        return false;
    }
    
    private static function byName(){
        return function($a, $b){
            return strcmp($a->getRealpath(), $b->getRealpath());
        };
    }
    
    private static function byCreated(){
        return function($a, $b){
            return ($a->getATime() - $b->getATime());
        };
    }
    
    private static function byChanged(){
        return function($a, $b){
            return ($a->getCTime() - $b->getCTime());
        };
    }
    
    /**
     * 
     * @param type $int
     * @return type
     */
    public static function getGnuSort($int){
        return self::$gnuSort[$int];
    }
    
}
