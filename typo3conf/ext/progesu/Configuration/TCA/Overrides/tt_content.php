<?php
defined('TYPO3_MODE') || die();

call_user_func(function () {

    /**
     * Add content elements to type dropdown
     * Set tab to true to add a new divider
     */

    $contentElements = [
        'common' => [
            ['name' => 'stage', 'icon' => 'content-text'],
            ['name' => 'subpage_stage', 'icon' => 'content-text'],
            ['name' => 'dual_text_teaser', 'icon' => 'content-text'],
            ['name' => 'quote_teaser', 'icon' => 'content-text'],
            ['name' => 'promotion_box_grid', 'icon' => 'content-text'],
            ['name' => 'promotion_box', 'icon' => 'content-text'],
            ['name' => 'accordion', 'icon' => 'content-text'],
            ['name' => 'accordion_item', 'icon' => 'content-text'],
            ['name' => 'contact_teaser', 'icon' => 'content-text'],
            ['name' => 'customers_teaser', 'icon' => 'content-text'],
            ['name' => 'customers_teaser_item', 'icon' => 'content-text'],
            ['name' => 'storage_list', 'icon' => 'content-text'],
        ],
    ];
    
    $lastElement = '';
    foreach ($contentElements as $tabElements) {
        foreach ($tabElements as $contentElement) {
            if ($contentElement['tab']) {
                \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
                    'tt_content',
                    'CType',
                    [
                            'LLL:EXT:progesu/Resources/Private/Language/locallang_be.xlf:tab.' . $contentElement['name'],
                            '--div--'
                        ],
                    $contentElement['before'] ? $contentElement['before'] : '',
                    'before'
                    );
            } else {
                \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
                    'tt_content',
                    'CType',
                    [
                            'LLL:EXT:progesu/Resources/Private/Language/locallang_be.xlf:' . $contentElement['name'] . '.label',
                            $contentElement['name'],
                            $contentElement['icon']
                        ],
                    $contentElement['after'] ? $contentElement['after'] : $lastElement,
                    'after'
                    );
                $lastElement = $contentElement['name'];
            }
        }
    }

    /**
     * Add new columns
     */ 
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'parent' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],    
            'bg_position' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:dona_victoria/Resources/Private/Language/locallang_db.xlf:elements.bg_position',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['top', 'top'],
                        ['center', 'center'],
                        ['bottom', 'bottom'],
                    ],
                ],
            ],
            'children' => [
                'exclude' => 0,
                'label' => 'LLL:EXT:dona_victoria/Resources/Private/Language/locallang_db.xlf:elements.children',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tt_content',
                    'foreign_field' => 'parent',
                    // 'maxitems' => 0,
                    'appearance' => [
                        'expandSingle' => 1,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 1,
                        'showPossibleLocalizationRecords' => 1,
                        'showAllLocalizationLink' => 1
                    ],
                ],
            ],    
            'cta_text' => [
                'label' => 'CTA Text',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255,
                ],
            ],
            'text_left' => [
                'label' => 'LLL:EXT:dona_victoria/Resources/Private/Language/locallang_db.xlf:elements.richtext',
                'config' => [
                    'type' => 'text',
                    'size' => 50,
                    'max' => 255,
                    'default' => '',
                    'enableRichtext' => true
                ],
            ],
            'text_right' => [
                'label' => 'LLL:EXT:dona_victoria/Resources/Private/Language/locallang_db.xlf:elements.richtext',
                'config' => [
                    'type' => 'text',
                    'size' => 50,
                    'max' => 255,
                    'default' => '',
                    'enableRichtext' => true
                ],
            ],
        ]
    );

    /**
     * Palette: CTA
     */
    $GLOBALS['TCA']['tt_content']['palettes']['cta'] = [
        'label' => 'LLL:EXT:dona_victoria/Resources/Private/Language/locallang_be.xlf:palette.cta',
        'showitem' => '
            header_link,
            cta_text
        ',
    ];

    $GLOBALS['TCA']['tt_content']['types']['stage'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,bodytext,cta_text,header_link,image;
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => false,
                ]
            ],
        ],
        'image' => [
            'config' => [
                'maxitems' => 2
            ]
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['subpage_stage'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,bodytext,bg_position,image;
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => false,
                ]
            ],
        ],
        'image' => [
            'config' => [
                'maxitems' => 2
            ]
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['dual_text_teaser'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,text_left,text_right;
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => false,
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tt_content']['types']['quote_teaser'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => false,
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tt_content']['types']['storage_list'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => false,
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tt_content']['types']['promotion_box'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,bodytext,header_link,cta_text,image;
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
        ],
        'image' => [
            'config' => [
                'maxitems' => 2
            ]
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['promotion_box_grid'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,children,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
            'children' => [
                'config' => [
                    'overrideChildTca' => [
                        'columns' => [
                            'CType' => [
                                'config' => [
                                    'default' => 'promotion_box',
                                ]
                            ],
                            'colPos' => [
                                'config' => [
                                    'default' => 99,
                                ]
                            ],
                        ]
                    ]
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tt_content']['types']['accordion_item'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,bodytext,header_link,cta_text,image,children;
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
        ],
        'image' => [
            'config' => [
                'maxitems' => 2
            ]
        ],
        'children' => [
            'config' => [
                'overrideChildTca' => [
                    'columns' => [
                        'CType' => [
                            'config' => [
                            ]
                        ],
                        'colPos' => [
                            'config' => [
                                'default' => 99,
                            ]
                        ],
                    ]
                ]
            ]
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['accordion'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,children,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
            'children' => [
                'config' => [
                    'overrideChildTca' => [
                        'columns' => [
                            'CType' => [
                                'config' => [
                                    'default' => 'promotion_box',
                                ]
                            ],
                            'colPos' => [
                                'config' => [
                                    'default' => 99,
                                ]
                            ],
                        ]
                    ]
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tt_content']['types']['customers_teaser_item'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,header_link,image;
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tt_content']['types']['customers_teaser'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,children,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
            'children' => [
                'config' => [
                    'overrideChildTca' => [
                        'columns' => [
                            'CType' => [
                                'config' => [
                                    'default' => 'customers_teaser_item',
                                ]
                            ],
                            'colPos' => [
                                'config' => [
                                    'default' => 99,
                                ]
                            ],
                        ]
                    ]
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tt_content']['types']['contact_teaser'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,header,bodytext,image,children,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
            'children' => [
                'config' => [
                    'overrideChildTca' => [
                        'columns' => [
                            // 'CType' => [
                            //     'config' => [
                            //         'default' => 'promotion_box',
                            //     ]
                            // ],
                            'colPos' => [
                                'config' => [
                                    'default' => 99,
                                ]
                            ],
                        ]
                    ]
                ]
            ],
            'image' => [
                'config' => [
                    'maxitems' => 1
                ]
            ],    
        ]
    ];



});