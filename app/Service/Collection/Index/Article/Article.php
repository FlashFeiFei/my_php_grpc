<?php

namespace App\Service\Collection\Index\Article;

use App\Service\Collection\Index\Index;

class Article implements Index
{
    const INDEX = 'collection';
    const TYPE = 'article';

    public function getIndexMappingsAndSettings()
    {
        $index = [
            'index' => self::INDEX,
            'body' => [
                'mappings' => [
                    self::TYPE => [
                        'properties' => [
                            'title' => [
                                'type' => 'text'
                            ],
                            'content' => [
                                'type' => 'text'
                            ],
                            'thumbnail' => [
                                'type' => 'text'
                            ],
                            'source' => [
                                'type' => 'text'
                            ],
                            'source_url' => [
                                'type' => 'text'
                            ],
                            'category' => [
                                'type' => 'text'
                            ],
                            'abstract' => [
                                'type' => 'text'
                            ],
                            'seo_title' => [
                                'type' => 'text'
                            ],
                            'seo_keywords' => [
                                'type' => 'text'
                            ],
                            'seo_description' => [
                                'type' => 'text'
                            ],
                        ]
                    ]
                ]
            ]
        ];

        return $index;
    }

}