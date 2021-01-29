<?php

return [
    'tools' => [
        'header' => [
            'text' => [
                'type' => 'string',
                'allowedTags' => ''
            ],
            'level' => [
                'type' => 'int',
                'canBeOnly' => [2,3,4]
            ]
        ],
        'paragraph' => [
            'text' => [
                'type' => 'string',
                'allowedTags' => 'i,b,u,a[href],code[class]'
            ]
        ],
        'quote' => [
            'text' => [
                'type' => 'string',
                'allowedTags' => 'i,b,u'
            ],
            'caption' => [
                'type' => 'string'
            ],
            'alignment' => [
                'type' => 'string',
                'canBeOnly' => ['left', 'center']
            ]
        ],
        'list' => [
            'items' => [
                'type' => 'array',
                'data' => [
                    '-' => [
                        'type' => 'string',
                        'allowedTags' => 'i,b,u'
                    ],
                ],
            ],
            'style' => [
                'type' => 'string',
                'canBeOnly' => ['ordered', 'unordered']
            ]
        ],
        'image' => [
            'caption' => [
                'type' => 'string',
                'required' => false,
                'allow_null' => true,
                'allowedTags' => 'i, b, a[href], code[class], mark[class]',
            ],
            'stretched' => [
                'type' => 'boolean'
            ],
            'url' => [
                'type' => 'string',
            ],
            'withBackground' => [
                'type' => 'boolean'
            ],
            'withBorder' => [
                'type' => 'boolean'
            ]
        ],
        'delimiter' => [
        ],
        'warning' => [
            'title' => [
                'type' => 'string'
            ],
            'message' => [
                'type' => 'string',
                'required' => false,
                'allow_null' => true,
            ]
        ]
    ]
];
