<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Test\FakeDrivers;
use Reea\FileSearcher\Bundle\Drivers\Lib\Types\DriverInterface;
/**
 * Description of FakeDriver
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class FakeDriver implements DriverInterface{
    
    public function getId(){
        return 'FakeDriver';
    }
    
    public function search(){
        die;
    }
    
    public function isEnabled(){
        return true;
    }
}
