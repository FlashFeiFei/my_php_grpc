<?php

namespace App\Service\Collection\Index;

interface Index
{
    /**
     * 获得索引的结构(可以理解为表结构)
     * @return array
     */
    public function getIndexMappingsAndSettings();

    /**
     * 获取索引名
     * @return string
     */
    public function getIndex();

    /**
     * 获取type名
     * @return string
     */
    public function getType();

    /**
     * 设置插入单条数据
     * @param array $data
     * @param null $id
     */
    public function setAddDocument(array $data, $id = null);

    /**
     * 获得添加单条的数据
     * @return array
     */
    public function getAddDocument();

    /**
     * 设置添加批量的数据
     * @param array $data
     */
    public function setAddDocumentBulk(array $data);

    /**
     * 获得批量添加的数据
     * @return array
     */
    public function getAddDocumentBulk();
}