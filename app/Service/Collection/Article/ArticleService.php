<?php

namespace App\Service\Collection\Article;

use App\Service\Collection\Index\Article\Article;
use App\Service\Collection\Command\Article\Article as ArticleCommand;

class ArticleService
{
    /**
     * 创建索引
     * @return array
     */
    public function createIndex()
    {
        $article_index = new Article();
        $article_command = new ArticleCommand();
        return $article_command->createIndex($article_index);
    }

    /**
     * 添加一个文档
     * @param array $data
     * @param null $id
     * @return array
     * @throws \Exception
     */
    public function addDocument(array $data, $id = null)
    {
        $article_index = new Article();
        $article_index->setAddDocument($data, $id);
        $article_command = new ArticleCommand();
        return $article_command->addDocument($article_index);
    }

    /**
     * 批量添加文档
     * 如果元素存在id字段，则取id作为文档的标识
     * 如果元素不存在id字段，在文档的标识为elasticsearch会自动生成
     * @param array $data
     * @return array
     */
    public function addDocumentBulk(array $data)
    {
        $article_index = new Article();
        $article_index->setAddDocumentBulk($data);
        $article_command = new ArticleCommand();
        return $article_command->addDocumentBulk($article_index);
    }
}