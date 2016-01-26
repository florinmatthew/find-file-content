<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Iterators;

/**
 * Description of FileExtensionIterator
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class FileExtensionIterator extends \FilterIterator{
    
    private $filters;
    
    function __construct(\Iterator $iterator, array $filters) {
        
        foreach ($filters as $filter){
            $this->filters[] = $filter;
        }
        
        parent::__construct($iterator);
    }
    
    public function accept() {
        
        $file = $this->current();
        
        if ($file->isDir() || !$file->isReadable()) {
            return false;
        }
        
        if(in_array($file->getExtension(), $this->filters)){
            return true;
        }
        
        return false;
    }
    
}
