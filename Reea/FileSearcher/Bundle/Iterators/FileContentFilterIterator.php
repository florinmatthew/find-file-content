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
    
    /**
     * 
     * @param \Iterator $iterator
     * @param type $included
     * @param type $excluded
     */
    function __construct(\Iterator $iterator, array $included, array $excluded = array()) {
        foreach ($included as $include){
            $this->textIncluded[] = $include;
        }
        
        if(NULL !== $excluded){
            foreach ($excluded as $exclue){
                $this->textExcluded[] = $exclude;
            }
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
        
        foreach ($this->textIncluded as $text){
            if(! preg_match("/".$text."/", $file_content)) return false;
        }
        
        foreach ($this->textExcluded as $text){
            if(! preg_match("/".$text."/", $file_content)) return false;
        }
        
        return true;
        
    }
    
}
