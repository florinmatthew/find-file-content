<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Iterators;
use \Reea\FileSearcher\Bundle\Helpers\FileInfo;
/**
 * Description of RecursiveDirectoryIterator
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class RecursiveDirectoryIterator extends \RecursiveDirectoryIterator{
    
    private $skipUnreadable;
    
    private $rewindable;
    
    function __construct($path, $skipUnreadable) {
        parent::__construct($path, \RecursiveDirectoryIterator::SKIP_DOTS);
        $this->skipUnreadable = $skipUnreadable;
    }
    
    public function getChildren() {
        try {
            $children = parent::getChildren();

            if ($children instanceof self) {
                $children->skipUnreadable = $this->skipUnreadable;
            }

            return $children;
        } catch (\UnexpectedValueException $e) {
            if ($this->skipUnreadable) {
                return new \RecursiveArrayIterator(array());
            } else {
                throw new \Reea\FileSearcher\Bundle\Exceptions\AccessDeniedException();
            }
        }
    }
    
    public function rewind(){
        if (false === $this->isRewindable()) {
            return;
        }

        parent::next();
        parent::rewind();
    }

    public function isRewindable() {
        if (null !== $this->rewindable) {
            return $this->rewindable;
        }
        
        $openDir = @opendir($this->getPath());
        
        if (FALSE !== $openDir) {
            $infoDir = stream_get_meta_data($openDir);
            closedir($openDir);

            if ($infoDir['seekable']) {
                return $this->rewindable = true;
            }
        }

        return $this->rewindable = false;
    }
    
    public function current() {
        $FileInfo = new FileInfo(parent::current()->getPathname(), $this->getSubPath(), $this->getSubPathname());
        return $FileInfo;
    }
    
}
