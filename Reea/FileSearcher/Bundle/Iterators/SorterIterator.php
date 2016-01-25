<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Iterators;

use Reea\FileSearcher\Bundle\Helpers\SortHelper;
/**
 * Description of SorterIterator
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class SorterIterator implements \IteratorAggregate{
    
    private $iterator;
    private $sort;
    
    /**
     * 
     * @param \Traversable $iterator
     * @param mixed $by int Id or callable
     * @throws Reea\FileSearcher\Bundle\Exceptions\InvalidSortArgumentException
     */
    function __construct(\Traversable $iterator, $by) {
        
        $this->iterator = $iterator;
        
        if(is_callable($by)){
            $this->sort = $by;
        }else{
            if(FALSE === SortHelper::getCallable(SortHelper::getSortVal($by))){
                throw new Reea\FileSearcher\Bundle\Exceptions\InvalidSortArgumentException();
            }
            $this->sort = SortHelper::getCallable(SortHelper::getSortVal($by));
        }
    }
    
    public function getIterator() {
        $array = iterator_to_array($this->iterator, true);
        uasort($array, $this->sort);
        
        return new \ArrayIterator($array);
    }
    
}
