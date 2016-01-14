<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reea\FileSearcher\Bundle\Helpers;
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
        'path' => [
            'type' => 'string',
            'required' => true
        ], 
        'textIncluded' => [
            'type' => 'array',
            'required' => true
        ], 
        'textExcluded' => [
            'type' => 'array',
            'required' => false
        ],
        'sort' => [
            'type' => 'string',
            'required' => false
        ]
    ];
    
    /**
     * 
     * @param array $settings
     * @throws Reea\FileSearcher\Bundle\Exceptions\InvalidTermsException
     */
    public static function validate(array $settings){
        foreach ($settings as $key=>$val){
            if(!self::$settings[$key]){
                throw new Reea\FileSearcher\Bundle\Exceptions\InvalidTermsException();
            }
        }
//        return self::$settings;
    }
    
}
