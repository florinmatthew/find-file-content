<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Drivers;
use Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface;
use \Reea\FileSearcher\Bundle\Helpers\SortHelper;
use \Reea\FileSearcher\Bundle\Helpers\CommandBuilder;
/**
 * Description of GnuCommandDriver
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class GnuCommandDriver extends AbstractCommandDriver implements DriverInterface{
    
    private static $id = "gnu_command";
    
    /**
     * { @inheritdoc }
     */
    public function getId(){
        return self::$id;
    }
    
    public function isEnabled(){
        return $this->o_systems->getType() === 1;
    }
    
    public function sort(CommandBuilder $builder, $sort) {
        
        if("name" !== $sort){
            $builder->push('-printf');
            $builder->addArgs(SortHelper::getGnuSort(SortHelper::getSortVal($sort)));
        }
        // >arg('-d ')
            // ->arg('-f2-')
        $builder->push('| sort -r');
    }
    
}
