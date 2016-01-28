<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Test\FakeDrivers;
/**
 * Description of WrongTypeDriver
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class WrongTypeDriver {
    
    
    public function getId(){
        return 'WrongTypeDriver';
    }
    
    public function search(){
        die;
    }
    
    public function isEnabled(){
        return true;
    }
    
}
