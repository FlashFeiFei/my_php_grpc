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
                'settings' => [
                    'analysis' => [
                        'analyzer' => [
                            //自定义中文分词器
                            'my_article_ch' => [
                                'type' => 'custom',
                                'tokenizer' => 'ik_max_word'
                            ]
                        ]
                    ]
                ],
                'mappings' => [
                    self::TYPE => [
                        'properties' => [
                            'title' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            'content' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            'thumbnail' => [
                                'type' => 'text'
                            ],
                            'source' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            'source_url' => [
                                'type' => 'text'
                            ],
                            'category' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            'abstract' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            'seo_title' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            'seo_keywords' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            'seo_description' => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                        ]
                    ]
                ]
            ]
        ];

        return $index;
    }

}