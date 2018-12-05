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
}