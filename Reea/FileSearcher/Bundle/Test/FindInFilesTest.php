<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Test;
use Reea\FileSearcher\Bundle\FindInFiles;
use Reea\FileSearcher\Bundle\Test\FakeDrivers\WrongTypeDriver;
use Reea\FileSearcher\Bundle\Test\FakeDrivers\FakeDriver;

/**
 * Description of FindInFilesTest
 *
 * @author Florian Matthew <florin.gligor@reea.net>
*/
class FindInFilesTest extends \PHPUnit_Framework_TestCase{
    
    private $finder;
    
    private $wrongDriver;
    
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
    
    function testSetUnreadable(){
        $this->assertTrue($this->finder->getUnreadableState());
        $this->finder->setUnreadable();
        $this->assertFalse($this->finder->getUnreadableState());
    }
    
    function testAppendDriver(){
        $wrongDriver = new WrongTypeDriver();
        $fakeDrvier = new FakeDriver();
        
        try {
            $this->finder->appendDriver($wrongDriver);
        } catch (\Exception $exc) {
            $this->assertEquals(1, 1);
        }

        $this->setExpectedException('Reea\FileSearcher\Bundle\Exceptions\DuplicateDriverException');
        $this->finder->appendDriver($fakeDrvier);
        $this->finder->appendDriver($fakeDrvier);
        
    }
    
}
