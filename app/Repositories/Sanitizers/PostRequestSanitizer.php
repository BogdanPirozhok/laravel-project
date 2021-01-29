<?php


namespace App\Repositories\Sanitizers;


use EditorJS\EditorJS;
use Illuminate\Http\Request;

class PostRequestSanitizer
{
    /**
     * @param Request $request
     * @return array
     * @throws \EditorJS\EditorJSException
     */
    public static function validateEditor(Request $request)
    {

        $content['id'] = $request->get('id');
        $content['data'] = $request->validated();
        unset($content['data']['id']);


        $editorBody = new EditorJS(json_encode($content['data']['body']), json_encode(self::getConfig()));

        $content['data']['body'] = $editorBody->getBlocks();

        return $content;
    }

    protected static function getConfig(): array
    {
        return [
            'tools' => [
                'header'    => [
                    'text'  => [
                        'type'        => 'string',
                        'allowedTags' => 'i,b,a[href]'
                    ],
                    'level' => [
                        'type'      => 'int',
                        'canBeOnly' => [1, 2, 3, 4, 5, 6]
                    ]
                ],
                'paragraph' => [
                    'text' => [
                        'type'        => 'string',
                        'allowedTags' => 'i,b,u,a[href],code[class]'
                    ]
                ],
                'quote'     => [
                    'text'      => [
                        'type'        => 'string',
                        'allowedTags' => 'i,b,a[href]'
                    ],
                    'caption'   => [
                        'type'        => 'string',
                        'allowedTags' => 'i,b,a[href]'
                    ],
                    'alignment' => [
                        'type'      => 'string',
                        'canBeOnly' => ['left', 'center']
                    ]
                ],
                'list'      => [
                    'items' => [
                        'type' => 'array',
                        'data' => [
                            '-' => [
                                'type'        => 'string',
                                'allowedTags' => 'i,b,u,a[href]'
                            ],
                        ],
                    ],
                    'style' => [
                        'type'      => 'string',
                        'canBeOnly' => ['ordered', 'unordered']
                    ]
                ],
                'image'     => [
                    'caption'        => [
                        'type'        => 'string',
                        'required'    => false,
                        'allow_null'  => true,
                        'allowedTags' => 'i, b, a[href], code[class], mark[class]',
                    ],
                    'stretched'      => [
                        'type' => 'boolean'
                    ],
                    'url'            => [
                        'type' => 'string',
                    ],
                    'withBackground' => [
                        'type' => 'boolean'
                    ],
                    'withBorder'     => [
                        'type' => 'boolean'
                    ]
                ],
                'delimiter' => [
                ],
                'warning'   => [
                    'title'   => [
                        'type'        => 'string',
                        'allowedTags' => 'i,b,a[href]'
                    ],
                    'message' => [
                        'type'       => 'string',
                        'required'   => false,
                        'allow_null' => true,
                    ]
                ]
            ]
        ];
    }


}
