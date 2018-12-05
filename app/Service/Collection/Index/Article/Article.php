<?php

namespace App\Service\Collection\Index\Article;

use App\Service\Collection\Index\Index;

class Article implements Index
{
    //索引
    const INDEX = 'collection';
    const TYPE = 'article';

    //属性
    //标题
    const TITLE_ATT = 'title';
    //内容
    const CONTENT_ATT = 'content';
    //缩略图
    const THUMBNAIL_ATT = 'thumbnail';
    //来源
    const SOURCE_ATT = 'source';
    //来源地址
    const SOURCE_URL_ATT = 'source_url';
    //类别
    const CATEGORY_ATT = 'category';
    //摘要
    const ABSTRACT_ATT = 'abstract';
    //title
    const SEO_TITLE_ATT = 'seo_title';
    //keywords
    const SEO_KEYWORDS_ATT = 'seo_keywords';
    //description
    const SEO_DESCRIPTION_ATT = 'seo_description';
    /**
     * 属性(单条添加)
     * @var array
     */
    private $attribute;

    /**
     * 属性(批量添加)
     * @var array
     */
    private $attributeBulk;

    /**
     * 设置数据
     * @param array $data
     * @param null $id
     * @throws \Exception
     */
    public function setArribute(array $data, $id = null)
    {
        //重新初始化一下,以免下次调用带了上次的数据
        $this->attribute = [];
        $this->attribute['index'] = self::INDEX;
        $this->attribute['type'] = self::TYPE;
        if (!empty($id)) {
            $this->attribute['id'] = $id;
        }
        if (count($data) != count($data, 1)) {
            throw new \Exception('必须是一维数组');
        }
        $this->attribute['body'] = $data;
    }

    /**
     * 批量设置属性
     * @param array $data
     */
    public function setArributeBulk(array $data)
    {
        //重新初始化一下,以免下次调用带了上次的数据
        $this->attributeBulk = [];

        foreach ($data as $key => $value) {
            $this->attributeBulk['body'][] = [
                'index' => [
                    '_index' => self::INDEX,
                    '_type' => self::TYPE,
                    '_id' => empty($value['id']) ? time() : $value['id']
                ]
            ];
            $this->attributeBulk['body'][] = [
                self::TITLE_ATT => empty($value[self::TITLE_ATT]) ? '' : $value[self::TITLE_ATT],
                self::CONTENT_ATT => empty($value[self::CONTENT_ATT]) ? '' : $value[self::CONTENT_ATT],
                self::THUMBNAIL_ATT => empty($value[self::THUMBNAIL_ATT]) ? '' : $value[self::THUMBNAIL_ATT],
                self::SOURCE_ATT => empty($value[self::SOURCE_ATT]) ? '' : $value[self::SOURCE_ATT],
                self::SOURCE_URL_ATT => empty($value[self::SOURCE_URL_ATT]) ? '' : $value[self::SOURCE_URL_ATT],
                self::CATEGORY_ATT => empty($value[self::CATEGORY_ATT]) ? '' : $value[self::CATEGORY_ATT],
                self::ABSTRACT_ATT => empty($value[self::ABSTRACT_ATT]) ? '' : $value[self::ABSTRACT_ATT],
                self::SEO_TITLE_ATT => empty($value[self::SEO_TITLE_ATT]) ? '' : $value[self::SEO_TITLE_ATT],
                self::SEO_KEYWORDS_ATT => empty($value[self::SEO_KEYWORDS_ATT]) ? '' : $value[self::SEO_KEYWORDS_ATT],
                self::SEO_DESCRIPTION_ATT => empty($value[self::SEO_DESCRIPTION_ATT]) ? '' : $value[self::SEO_DESCRIPTION_ATT]
            ];
        }
    }

    /**
     * 单条属性
     * @return array
     */
    public function getAddDocument()
    {
        return $this->attribute;
    }

    /**
     * 获得批量添加的数据
     * @return array
     */
    public function getAddDocumentBulk()
    {
        return $this->attributeBulk;
    }

    public function getIndex()
    {
        return self::INDEX;
    }

    public function getType()
    {
        return self::TYPE;
    }

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
                            self::TITLE_ATT => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            self::CONTENT_ATT => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            self::THUMBNAIL_ATT => [
                                'type' => 'text'
                            ],
                            self::SOURCE_ATT => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            self::SOURCE_URL_ATT => [
                                'type' => 'text'
                            ],
                            self::CATEGORY_ATT => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            self::ABSTRACT_ATT => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            self::SEO_TITLE_ATT => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            self::SEO_KEYWORDS_ATT => [
                                'type' => 'text',
                                'analyzer' => 'my_article_ch',
                                'search_analyzer' => 'my_article_ch'
                            ],
                            self::SEO_DESCRIPTION_ATT => [
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