<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Drivers;
use Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface;
/**
 * Description of DefaultDriver
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class DefaultDriver implements DriverInterface{
    
    static $name = "default";
    
    public function getId() {
        return static::$name;
    }
}
