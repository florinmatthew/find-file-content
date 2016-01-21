<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Iterators;

/**
 * Description of IgnoredFoldersIterator
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class IgnoredFoldersIterator extends \FilterIterator{
    
    private $ignored;
    
    function __construct(\Iterator $iterator, array $ignored) {
        parent::__construct($iterator);
        foreach ($ignored as $folder){
            $this->ignored[] = $folder;
        }
        
    }
    
    public function accept() {
        
        $path = $this->isDir() ? $this->current()->getSubpathName() : $this->current()->getPathname();
        $path = strtr($path, '\\', '/');
        
        if($this->isDir()){
            foreach ($this->ignored as $folder_name){
                if(preg_match("/".$folder_name."/", $this->current()->geFileName())){
                    return false;
                }
            }
        }
        return true;
    }
    
}
