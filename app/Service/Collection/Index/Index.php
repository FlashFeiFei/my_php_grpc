<?php

namespace App\Service\Collection\Index;

interface Index
{
    /**
     * 获得索引的结构(可以理解为表结构)
     * @return array
     */
    public function getIndexMappingsAndSettings();
}