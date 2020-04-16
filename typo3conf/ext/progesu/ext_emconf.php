<?php

/**
 * Extension Manager/Repository config file for ext "progesu".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Progesu',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.5.99',
            'fluid_styled_content' => '9.5.0-9.5.99',
            'rte_ckeditor' => '9.5.0-9.5.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'SmartDigitalGains\\Progesu\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Tizian Thost',
    'author_email' => 'tizian@smartdigitalgains.com',
    'author_company' => 'smart digital gains',
    'version' => '1.0.0',
];
