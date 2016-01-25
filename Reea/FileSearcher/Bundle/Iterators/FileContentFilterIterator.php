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
    
    private $textIncluded;
    
    private $textExcluded;
    
    /**
     * 
     * @param \Iterator $iterator
     * @param type $included
     * @param type $excluded
     */
    function __construct(\Iterator $iterator, $included, $excluded = "") {
        
        $this->textIncluded = $included;
        
        if(NULL !== $excluded){
            $this->textExcluded = $excluded;
        }
        
        parent::__construct($iterator);
    }
    
    public function accept() {
        
        if(NULL == $this->textIncluded){
            return true;
        }
        
        $file = $this->current();
        
        if ($file->isDir() || !$file->isReadable()) {
            return false;
        }

        $file_content = $file->getFileContent();
        
        if(NULL === $file_content) return false;
        
        if(! preg_match("/".$this->textIncluded."/", $file_content)) return false;
        
        return true;
        
    }
    
}
