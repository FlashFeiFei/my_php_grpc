<?php

namespace App\Service\Collection\Index\Article;

use App\Service\Collection\Index\Index;

class Article implements Index
{
    //索引
    const INDEX = 'collection';
    const TYPE = 'article';

    /**
     * 主键标识，用于添加自定义id索引时，获取id数据的标识
     */
    const PRIMARY_KEY = self::INDEX . '.' . self::TYPE . 'primary.key';

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
     * 构建一个添加文档的格式对象
     * @param $title
     * @param $content
     * @param $thumbnail
     * @param $source
     * @param $source_url
     * @param $category
     * @param $abstract
     * @param $seo_title
     * @param $seo_keywords
     * @param $seo_description
     * @return array
     */
    static public function buildDocument($title, $content, $thumbnail, $source, $source_url, $category, $abstract, $seo_title, $seo_keywords, $seo_description)
    {
        return [
            Article::TITLE_ATT => $title,
            Article::CONTENT_ATT => $content,
            Article::THUMBNAIL_ATT => $thumbnail,
            Article::SOURCE_ATT => $source,
            Article::SOURCE_URL_ATT => $source_url,
            Article::CATEGORY_ATT => $category,
            Article::ABSTRACT_ATT => $abstract,
            Article::SEO_TITLE_ATT => $seo_title,
            Article::SEO_KEYWORDS_ATT => $seo_keywords,
            Article::SEO_DESCRIPTION_ATT => $seo_description
        ];
    }

    /**
     * 构建自定义的id的
     * @param $id
     * @param $title
     * @param $content
     * @param $thumbnail
     * @param $source
     * @param $source_url
     * @param $category
     * @param $abstract
     * @param $seo_title
     * @param $seo_keywords
     * @param $seo_description
     * @return array
     */
    static public function buildDocumentByid($id, $title, $content, $thumbnail, $source, $source_url, $category, $abstract, $seo_title, $seo_keywords, $seo_description)
    {
        return [
            //用于获取id的标识
            Article::PRIMARY_KEY => $id,
            Article::TITLE_ATT => $title,
            Article::CONTENT_ATT => $content,
            Article::THUMBNAIL_ATT => $thumbnail,
            Article::SOURCE_ATT => $source,
            Article::SOURCE_URL_ATT => $source_url,
            Article::CATEGORY_ATT => $category,
            Article::ABSTRACT_ATT => $abstract,
            Article::SEO_TITLE_ATT => $seo_title,
            Article::SEO_KEYWORDS_ATT => $seo_keywords,
            Article::SEO_DESCRIPTION_ATT => $seo_description
        ];
    }

    /**
     * 设置文档
     * @param array $data
     * @param null $id
     * @throws \Exception
     */
    public function setAddDocument(array $data, $id = null)
    {
        //重新初始化一下,以免下次调用带了上次的数据
        $this->attribute = [];
        $this->attribute['index'] = self::INDEX;
        $this->attribute['type'] = self::TYPE;
        if (count($data) != count($data, 1)) {
            throw new \Exception('必须是一维数组');
        }
        //是否有自定义的id
        if (!empty($id)) {
            $this->attribute['id'] = $id;
        }
        //是否自定义主键
        if (array_key_exists(Article::PRIMARY_KEY, $data)) {
            //自定义主键
            $this->attribute['id'] = Article::PRIMARY_KEY;
        }

        $this->attribute['body'] = $data;
    }

    /**
     * @param array $data
     */
    public function setAddDocumentBulk(array $data)
    {
        //重新初始化一下,以免下次调用带了上次的数据
        $this->attributeBulk = [];

        foreach ($data as $key => $value) {
            //是否自定义主键
            if (array_key_exists(Article::PRIMARY_KEY, $value)) {
                //自定义主键
                $this->attributeBulk['body'][] = [
                    'index' => [
                        '_index' => self::INDEX,
                        '_type' => self::TYPE,
                        '_id' => $value[Article::PRIMARY_KEY]
                    ]
                ];
            } else {
                //非自定义主键
                $this->attributeBulk['body'][] = [
                    'index' => [
                        '_index' => self::INDEX,
                        '_type' => self::TYPE
                    ]
                ];
            }
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
                        //定义分词
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