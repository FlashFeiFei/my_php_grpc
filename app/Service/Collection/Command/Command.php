<?php
/**
 * Created by PhpStorm.
 * User: liangyu
 * Date: 2018/12/5
 * Time: 14:57
 */

namespace App\Service\Collection\Command;

use App\Service\Collection\Index\Index;
use Elasticsearch\ClientBuilder;

abstract class Command
{
    /**
     * @var \Elasticsearch\Client
     */
    private $client;
    private $hosts = [
        '116.62.246.162:9200'
    ];

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts($this->hosts)
            ->build();
    }

    /**
     * 创建索引
     * @param Index $index
     * @return array
     */
    public function createIndex(Index $index)
    {
        $response = $this->client->indices()->create($index->getIndexMappingsAndSettings());
        return $response;
    }

    /**
     * 添加一个文档
     * @param Index $index
     * @return array
     */
    public function addDocument(Index $index)
    {
        return $this->client->index($index->getAddDocument());
    }

    /**
     * 批量添加索引
     * @param Index $index
     * @return array
     */
    public function addDocumentBulk(Index $index)
    {
        return $this->client->bulk($index->getAddDocumentBulk());
    }
}