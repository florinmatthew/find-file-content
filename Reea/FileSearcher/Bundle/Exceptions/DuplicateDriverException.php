<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\FileSearcher\Bundle\Exceptions;

/**
 * Description of DuplicateDriverException
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class DuplicateDriverException extends \Exception{
    protected $message = "Duplicate driver name!";
}
