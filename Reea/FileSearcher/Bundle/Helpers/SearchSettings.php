<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Helpers;
use Reea\FileSearcher\Bundle\Exceptions\InvalidTermsException;
/**
 * Description of SearchSettings
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class SearchSettings {
    
    /**
     * @var array 
     */
    private static $settings = [
        'textIncluded' => [
            'type'  => 'array',
            'required' => true
        ], 
        'textExcluded' => [
            'type'  => 'array',
            'required' => false
        ],
        'sort' => [
            'type'  => 'string',
            'required' => false
        ],
        'matches_regex' => [
            'type'  => 'array',
            'required' => true
        ],
        'filters'   => [
            'type'  => 'array',
            'required' => false
        ],
        'ignoreFolders' => [
            'type'  => 'array',
            'required' => false
        ]
    ];
    
    /**
     * 
     * @param array $settings
     * @throws Reea\FileSearcher\Bundle\Exceptions\InvalidTermsException
     */
    public static function validate(array $settings){
        
        if(0 === count($settings))
            throw new InvalidTermsException();
        
        foreach (self::$settings as $name=> $setting){
            if(TRUE === $setting['required']){
                if(! array_key_exists($name, $settings) || (array_key_exists($name, $settings) && NULL == $settings[$name])){
                    throw new InvalidTermsException();
                }
            }
        }        
        
        return true;
    }
    
}
