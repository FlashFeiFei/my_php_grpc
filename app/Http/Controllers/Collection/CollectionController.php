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
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function collection()
    {

//        $this->addDocument();
    }

    /**
     * 创建索引
     */
    private function createIndex()
    {
        //创建索引
        $response = (new ArticleService())->createIndex();
        return response()->json($response);
    }

    /**
     * 添加一个文档
     *
     */
    public function addDocument(Request $request)
    {
        //检查参数
        $check_result = $this->checkeDocumentDataFormat($request->input('title'), $request->input('content'), $request->input('thumbnail'),
            $request->input('source'), $request->input('source_url'), $request->input('category'), $request->input('abstract'),
            $request->input('seo_title'), $request->input('seo_keywords'), $request->input('seo_description'));

        if (!empty($check_result)) {
            //检查参数出错结果
            return response()->json([
                'errMsg' => $check_result
            ]);
        }

        //添加一个文档
        $response = (new ArticleService())->addDocument(ArticleService::buildDocument($request->input('title'), $request->input('content'), $request->input('thumbnail'),
            $request->input('source'), $request->input('source_url'), $request->input('category'), $request->input('abstract'),
            $request->input('seo_title'), $request->input('seo_keywords'), $request->input('seo_description')));

        return response()->json($response);
    }

    /**
     * 批量添加文档
     */
    public function addDocumentBulk(Request $request)
    {
        $json_data = $request->input('article_json');
        if (empty($json_data)) {
            return response()->json([
                'errMsg' => 'article_json' . 'article_json为空'
            ]);
        }
        $json_data = json_decode($json_data, true);
        $decode_result = json_last_error();
        if ($decode_result != JSON_ERROR_NONE) {
            return response()->json([
                'errMsg' => 'article_json' . '解码失败' . $decode_result
            ]);
        }

        //检查数据
        $index_data = [];
        foreach ($json_data as $index => $item) {
            $check_result = $this->checkeDocumentDataFormat($item['title'], $item['content'], $item['thumbnail'], $item['source'], $item['source_url'],
                $item['category'], $item['abstract'], $item['seo_title'], $item['seo_keywords'], $item['seo_description']);
            if (!empty($check_result)) {
                //检查参数出错结果
                response()->json([
                    'errMsg' => '第' . $index . '项数据有错' . '错误信息:' . $check_result
                ]);
            }
            //批量生成文档的数据
            array_push($index_data, ArticleService::buildDocument($item['title'], $item['content'], $item['thumbnail'], $item['source'], $item['source_url'],
                $item['category'], $item['abstract'], $item['seo_title'], $item['seo_keywords'], $item['seo_description']));
        }

        //批量生成文档
        $response = (new ArticleService())->addDocumentBulk($index_data);
        return response()->json($response);
    }

    /**
     * 检查添加文档的参数是否存在
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
     * @return string
     */
    private function checkeDocumentDataFormat($title, $content, $thumbnail, $source, $source_url, $category, $abstract, $seo_title, $seo_keywords, $seo_description)
    {
        $parame = [
            'title' => $title,
            'content' => $content,
            'thumbnail' => $thumbnail,
            'source' => $source,
            'source_url' => $source_url,
            'category' => $category,
            'abstract' => $abstract,
            'seo_title' => $seo_title,
            'seo_keywords' => $seo_keywords,
            'seo_description' => $seo_description
        ];
        foreach ($parame as $key => $value) {
            if (empty($value)) {
                return '参数' . $key . '为空';
            }
        }
        return '';
    }
}