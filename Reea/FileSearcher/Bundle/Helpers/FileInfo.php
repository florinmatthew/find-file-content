<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Helpers;

/**
 * Description of FileInfo
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class FileInfo extends \SplFileInfo{
    
    private $subPath;
    
    private $subPathName;
    
    function __construct($file, $subPath, $subPathName) {
        parent::__construct($file);
        
        $this->subPath = $subPath;
        $this->subPathName = $subPathName;
    }
    
    public function getFileContent() {
        
        $content = file_get_contents($this->getPathname());
        
        if (false === $content) {
            throw new \RuntimeException();
        }

        return $content;
    }
    
    public function getSubpath() {
        return $this->subPath;
    }
    
    public function getSubpathName() {
        return $this->subPathName;
    }
    
}
