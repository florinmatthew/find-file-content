<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Test;
use Reea\FileSearcher\Bundle\FindInFiles;
/**
 * Description of FindInFilesTest
 *
 * @author Florian Matthew <florin.gligor@reea.net>
*/
class FindInFilesTest extends \PHPUnit_Framework_TestCase{
    
    private $finder;
    
    public function setUp(){
        
        $this->finder = new FindInFiles();
    }
    
    public function tearDown() {  }
    
    /** @test */
    function testSetPath() {
//        $this->setExpectedException('Exception');
        $this->finder->setPath('/var/www/html/findFileContentSymfony/Dummy/');
        $this->assertEquals($this->finder->getPath(), '/var/www/html/findFileContentSymfony/Dummy/');
    }
    
}
