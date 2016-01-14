<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Drivers\Lib\Types;
/**
 * Description of DriverInterface
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
interface DriverInterface {
    
    /**
     * Return the ID of the driver.
     */
    public function getId();
    
    public function search($path);
    
}
