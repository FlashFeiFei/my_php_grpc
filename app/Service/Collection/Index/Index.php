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
     * 获得添加单条的数据
     * @return array
     */
    public function getAddDocument();

    /**
     * 获得批量添加的数据
     * @return array
     */
    public function getAddDocumentBulk();
}