<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Iterators;

/**
 * Description of FileContentFilterIterator
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class FileContentFilterIterator extends \FilterIterator{
    
    private $textIncluded = array();
    
    private $textExcluded = array();
    
    function __construct(\Iterator $iterator, $excluded = array(), $included = array()) {
        parent::__construct($iterator);
        $this->textIncluded = $excluded;
        $this->textExcluded = $included;
    }
    
    public function accept() {
        
        if(NULL == $this->textIncluded || NULL == $this->textExcluded){
            return true;
        }
        
        $file = $this->current();

        if ($file->isDir() || !$file->isReadable()) {
            return false;
        }

        $file_content = $file->getContents();
        
        if(NULL === $file_content) return false;
        
        foreach ($this->textIncluded as $text){
            if(! preg_match($text, $file_content)) return false;
        }
        
        foreach ($this->textExcluded as $text){
            if(! preg_match($text, $file_content)) return false;
        }
        
        return true;
        
    }
    
}
