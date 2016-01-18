<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Iterators;
/**
 * Iterator for file names.
 * 
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class FileFilterIterator extends \FilterIterator{
    
    private $filters = array();
    
    function __construct(\Iterator $iterator, $filters = array()) {
        parent::__construct($iterator);
        $this->filters = $filters;
    }
    
    public function accept() {
        $file_name = $this->current()->getFileName();
        
        foreach ($this->filters as $filter){
            if($file_name == $filter){
                return false;
            }
        }
        
        return true;
    }
    
}
