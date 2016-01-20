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
    
    function __construct($file) {
        parent::__construct($file);
    }
    
    public function getFileContent() {
        
        $content = file_get_contents($this->getPathname());
        
        if (false === $content) {
            throw new \RuntimeException();
        }

        return $content;
    }
    
}
