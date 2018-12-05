<?php
/**
 * Created by PhpStorm.
 * User: liangyu
 * Date: 2018/12/5
 * Time: 11:42
 */

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Service\Collection\Article\ArticleService;

class CollectionController  extends Controller
{
    public function collection()
    {
        //创建索引
//        $response = (new ArticleService())->createIndex();
//        dd($response);
        //添加一个文档
        $response = (new ArticleService())->addDocument([

        ]);
        dd($response);
    }
}