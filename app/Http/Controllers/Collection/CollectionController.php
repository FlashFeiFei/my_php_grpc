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
    private function addDocument(Request $request)
    {
        $parame = [
            'title' => $request->input('title', ''),
            'content' => $request->input('content', ''),
            'thumbnail' => $request->input('thumbnail', ''),
            'source' => $request->input('source', ''),
            'source_url' => $request->input('source_url', ''),
            'category' => $request->input('category', ''),
            'abstract' => $request->input('abstract', ''),
            'seo_title' => $request->input('seo_title', ''),
            'seo_keywords' => $request->input('seo_keywords', ''),
            'seo_description' => $request->input('seo_description', ''),
        ];
        foreach ($parame as $key => $value) {
            if (empty($value)) {
                response()->json([
                    'errMsg' => '参数' . $key . '为空'
                ]);
            }
        }

        $response = (new ArticleService())->addDocument(ArticleService::buildDocument($parame['title'], $parame['content'], $parame['thumbnail'], $parame['source'], $parame['source_url'],
            $parame['category'], $parame['abstract'], $parame['seo_title'], $parame['seo_keywords'], $parame['seo_description']));
        response()->json($response);
    }

    /**
     * 批量添加文档
     */
    private function addDocumentBulk()
    {
        //第一条数据
        $title_2 = '我和僵尸有个约会第二部';
        $content_2 = '天地混沌，太初有情，女娲泥土造人，炼彩石补天，为人类缔造生机。谁知人类贪婪成性，自我走向灭亡。女娲不惜耗尽心力，将五种恶性权力：妒忌、怨恨、迷茫、痴恋，自人间抽出，化成五色彩石，使人间重归洁净。无奈事与愿违，五种恶性在人间再生，女娲心痛恶绝，决定向人类发出最后通牒，矢言在万世后回归之日，人类若仍是杀戮不断，便要将天地毁灭。说罢，女娲把肉身封在五彩精魂之中，自我流放于九天。非人非鬼亦非神的僵尸真祖将臣眼见女娲为人类流露的喜与悲，对她早已迷恋。自女娲去后，将臣便进入沉睡中，静待女娲的回归。公元二零零零年，距离女娲回归只有一年的人世间，香港警察况天佑邂逅驱魔龙族马氏第四十代传人马小玲，两人互生情愫。苦恋天佑的小玲好友王珍珍被电视台监制司徒奋仁追求，陷于感情困局中。原来奋仁由日东集团前主席山本一夫的DNA复制，因有超能力而被误为救世主，后发现超能力是脑生冻瘤所致。这时香港出现僵尸杀人事件，幕后黑手日东集团主席堂本静遇上早已从沉睡中醒来的将臣，终如愿变成僵尸。成为了僵尸的堂本静恋上了金未来，且诞下儿子尼诺。奋仁为了不舍珍珍，让堂本静吸血，珍珍阻止时被杀，奋仁精神崩溃。纯真的将臣以为将世人变作僵尸，便能将之救赎，助人类避过女娲降世的一劫。六十年前被将臣咬过的天佑，与小玲携手等待女娲回归，誓要将之铲除；钟情女娲至天荒地老的将臣却准备了盛大的婚宴，迎接心中的女神。五色彩石撞向人间之际，是人类的浩劫、也是将臣与女娲缘尽之时';
        $thumbnail_2 = 'https://uploadfile.xcx.co.ltd/uploadfile/image/0/0/1/2018-02/15192662628323.jpg';
        $source_2 = '百度百科';
        $source_url_2 = 'https://www.baidu.com/s?wd=%E6%88%91%E5%92%8C%E5%83%B5%E5%B0%B8%E6%9C%89%E4%B8%AA%E7%BA%A6%E4%BC%9A&rsv_spt=1&rsv_iqid=0x82f67a98000001cf&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&rqlang=cn&tn=baiduhome_pg&rsv_enter=1&oq=php%2520%25E5%2588%25A4%25E6%2596%25AD%25E6%2595%25B0%25E7%25BB%2584%25E6%2598%25AF%25E5%2590%25A6%25E4%25B8%25BA%25E4%25B8%2580%25E7%25BB%25B4%25E6%2595%25B0%25E7%25BB%2584&rsv_t=64aefHy3%2F2weA%2B3J2hnLmLS5cY2bHmXwBpU%2BrGvHcU27id0MdQvpRvegpBR57rKsHVuC&inputT=10906&rsv_pq=c3360abd0000047b&rsv_sug3=99&rsv_sug1=100&rsv_sug7=100&bs=php%20%E5%88%A4%E6%96%AD%E6%95%B0%E7%BB%84%E6%98%AF%E5%90%A6%E4%B8%BA%E4%B8%80%E7%BB%B4%E6%95%B0%E7%BB%84';
        $category_2 = '香港电视剧';
        $abstract_2 = <<<EOT
天地混沌，太初有情，<b>女娲</b>泥土造人，炼彩石补天，为人类缔造生机。谁知人类贪婪成性，自我走向<p>灭亡</p>。女娲不惜耗尽心力，将五种恶性权力：妒忌、怨恨、迷茫、痴恋，自人间抽出，化成五色彩石，使人间重归洁净。无奈事与愿违，五种恶性在人间再生，女娲心痛恶绝，决定向人类发出最后通牒，矢言在万世后回归之日，人类若仍是杀戮不断，便要将天地毁灭。说罢，女娲把肉身封在五彩精魂之中，自我流放于九天。非人非鬼亦非神的僵尸真祖将臣眼见女娲为人类流露的喜与悲，对她早已迷恋。自女娲去后，将臣便进入沉睡中，静待女娲的回归。公元二零零零年，距离女娲回归只有一年的人世间，香港警察况天佑邂逅驱魔龙族马氏第四十代传人马小玲，两人互生情愫。苦恋天佑的小玲好友王珍珍被电视台监制司徒奋仁追求，陷于感情困局中。原来奋仁由日东集团前主席山本一夫的DNA复制，因有超能力而被误为救世主，后发现超能力是脑生冻瘤所致。这时香港出现僵尸杀人事件，幕后黑手日东集团主席堂本静遇上早已从沉睡中醒来的将臣，终如愿变成僵尸。成为了僵尸的堂本静恋上了金未来，且诞下儿子尼诺。奋仁为了不舍珍珍，让堂本静吸血，珍珍阻止时被杀，奋仁精神崩溃。纯真的将臣以为将世人变作僵尸，便能将之救赎，助人类避过女娲降世的一劫。六十年前被将臣咬过的天佑，与小玲携手等待女娲回归，誓要将之铲除；钟情女娲至天荒地老的将臣却准备了盛大的婚宴，迎接心中的女神。五色彩石撞向人间之际，是人类的浩劫、也是将臣与女娲缘尽之时
EOT;
        $seo_title_2 = '我和僵尸有个约会第二部';
        $seo_keywords_2 = '我和僵尸有个约会第二部';
        $seo_description_2 = '香港tvb电视剧我和僵尸有个约会';

        //第二条数据
        $title_3 = '我和僵尸有个约会第三部';
        $content_3 = '曾经有人做过统计，现代社会每天就有78.3个传说消失，有说因现代父母越来越忙，没时间跟小朋友说故事，亦有说因现代人已不再相信传说，更加不相信传说中的英雄曾经存在过。但不理世人相不相信，无论传说消失的速度有多快，有关马小玲、况天佑等人的传说，依然会永远流传下去，因为他们不单止真真实实的存在过，还曾在这世界留下欢笑，留下眼泪，更留下了一段段令人难以忘记的动人故事。';
        $thumbnail_3 = 'https://uploadfile.xcx.co.ltd/uploadfile/image/0/0/1/2018-07/15320587641357.png';
        $source_3 = '百度百科';
        $source_url_3 = 'https://www.baidu.com/s?wd=%E6%88%91%E5%92%8C%E5%83%B5%E5%B0%B8%E6%9C%89%E4%B8%AA%E7%BA%A6%E4%BC%9A&rsv_spt=1&rsv_iqid=0x82f67a98000001cf&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&rqlang=cn&tn=baiduhome_pg&rsv_enter=1&oq=php%2520%25E5%2588%25A4%25E6%2596%25AD%25E6%2595%25B0%25E7%25BB%2584%25E6%2598%25AF%25E5%2590%25A6%25E4%25B8%25BA%25E4%25B8%2580%25E7%25BB%25B4%25E6%2595%25B0%25E7%25BB%2584&rsv_t=64aefHy3%2F2weA%2B3J2hnLmLS5cY2bHmXwBpU%2BrGvHcU27id0MdQvpRvegpBR57rKsHVuC&inputT=10906&rsv_pq=c3360abd0000047b&rsv_sug3=99&rsv_sug1=100&rsv_sug7=100&bs=php%20%E5%88%A4%E6%96%AD%E6%95%B0%E7%BB%84%E6%98%AF%E5%90%A6%E4%B8%BA%E4%B8%80%E7%BB%B4%E6%95%B0%E7%BB%84';
        $category_3 = '香港电视剧';
        $abstract_3 = <<<EOT
曾经有人做过<b>统计</b>，现代社会每天就有78.3个传说<i>消失</i>，有说因现代父母越来越忙，没时间跟小朋友说故事，亦有说因现代人已不再相信传说，更加不相信传说中的英雄曾经存在过。但不理世人相不相信，无论传说消失的速度有多快，有关马小玲、况天佑等人的传说，依然会永远流传下去，因为他们不单止真真实实的存在过，还曾在这世界留下欢笑，留下眼泪，更留下了一段段令人难以忘记的动人故事。
EOT;
        $seo_title_3 = '我和僵尸有个约会第三部';
        $seo_keywords_3 = '我和僵尸有个约会第三部';
        $seo_description_3 = '香港tvb电视剧我和僵尸有个约会';

        //构建数据
        $index_data = [];
        array_push($index_data, ArticleService::buildDocument($title_2, $content_2, $thumbnail_2, $source_2, $source_url_2, $category_2, $abstract_2, $seo_title_2, $seo_keywords_2, $seo_description_2));
        array_push($index_data, ArticleService::buildDocument($title_3, $content_3, $thumbnail_3, $source_3, $source_url_3, $category_3, $abstract_3, $seo_title_3, $seo_keywords_3, $seo_description_3));

        $response = (new ArticleService())->addDocumentBulk($index_data);
        dd($response);
    }
}