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

class CollectionController extends Controller
{
    public function collection()
    {

        $this->addDocument();
    }

    /**
     * 创建索引
     */
    private function createIndex()
    {
        //创建索引
        $response = (new ArticleService())->createIndex();
        dd($response);
    }

    /**
     * 添加一个文档
     *
     */
    private function addDocument()
    {
        $title = '我和僵尸有个约会第一部';
        $content = '1938年正值日寇侵华，中国各地烽火连连。游击队队长况国华与日军少佐山本一夫苦战，况国华为保农户之子何复生， 单独和山本一夫决战，并打跑了山本一夫。复生被挟持，国华无奈放下武器投降被枪击中。频死之际，僵尸王将臣出现，把三人鲜血尽吸。驱魔一族当代传人马丹娜赶至，虽把将臣击退，却失去了况国华及何复生的踪影。马丹娜深知被将臣所咬便成僵尸，预言后世从此多事。';
        $thumbnail = 'https://uploadfile.xcx.co.ltd/uploadfile/image/0/0/1/2018-04/15231716687961.png';
        $source = '百度百科';
        $source_url = 'https://www.baidu.com/s?wd=%E6%88%91%E5%92%8C%E5%83%B5%E5%B0%B8%E6%9C%89%E4%B8%AA%E7%BA%A6%E4%BC%9A&rsv_spt=1&rsv_iqid=0x82f67a98000001cf&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&rqlang=cn&tn=baiduhome_pg&rsv_enter=1&oq=php%2520%25E5%2588%25A4%25E6%2596%25AD%25E6%2595%25B0%25E7%25BB%2584%25E6%2598%25AF%25E5%2590%25A6%25E4%25B8%25BA%25E4%25B8%2580%25E7%25BB%25B4%25E6%2595%25B0%25E7%25BB%2584&rsv_t=64aefHy3%2F2weA%2B3J2hnLmLS5cY2bHmXwBpU%2BrGvHcU27id0MdQvpRvegpBR57rKsHVuC&inputT=10906&rsv_pq=c3360abd0000047b&rsv_sug3=99&rsv_sug1=100&rsv_sug7=100&bs=php%20%E5%88%A4%E6%96%AD%E6%95%B0%E7%BB%84%E6%98%AF%E5%90%A6%E4%B8%BA%E4%B8%80%E7%BB%B4%E6%95%B0%E7%BB%84';
        $category = '香港电视剧';
        $abstract = <<<EOT
<p>1938年正值日寇侵华，中国各地烽火连连。游击队<p>队长</p>况国华与日军少佐山本一夫苦战，况国华为保农户之子何复生， 单独和山本一夫决战，并打跑了山本一夫。复生被挟持，国华无奈放下武器投降被枪击中。频死之际，僵尸王将臣出现，把三人鲜血尽吸。驱魔一族当代传人马丹娜赶至，虽把将臣击退，却失去了况国华及何复生的踪影。马丹娜深知被将臣所咬便成僵尸，预言后世从此多事</p>。
EOT;
        $seo_title = '我和僵尸有个约会';
        $seo_keywords = '我和僵尸有个约会';
        $seo_description = '香港tvb电视剧我和僵尸有个约会';
        $response = (new ArticleService())->addDocument(ArticleService::buildDocument($title, $content, $thumbnail, $source, $source_url, $category, $abstract, $seo_title, $seo_keywords, $seo_description));
        dd($response);
    }
}