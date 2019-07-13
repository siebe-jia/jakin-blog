<?php
namespace app\index\controller;

use app\index\model\Article as ArticleModel;
use app\lib\parsedown\Parsedown;
use think\facade\Url;

class Index extends BaseController
{
    public function index()
    {
        $articleList = $this->getArticleList();
        $this->getNavRecommend();
        $this->getArticleCountByType();
        $this->assign("articleList",$articleList);
        return $this->fetch('index');
    }
    public function getArticleInfo($id)
    {
        $article = ArticleModel::get($id-1024);
        $info = $article->hidden(['status','update_time'])->toArray();
        $Parsedown = new Parsedown();
        $info['content'] = $Parsedown->text($info['content']);
        $type = $article->type;
        $article->look = ['inc', 1];
        $article->save();
        $this->assign("info",$info);
        $correlation = ArticleModel::getArticleInfoByType($type);
        $this->assign("correlation",$correlation);
        $this->getNavRecommend();
        $this->getArticleCountByType();
        $url = Url::build('index/Index/getArticleInfo','id='.$id);
        $this->assign('url',$url);
        return $this->fetch('blog');
    }
    private function getArticleList(){
        $article = ArticleModel::getArticleList();
        $articleList = $article->hidden(['content','image_list.pivot','status','update_time'])->toArray();
        return $articleList;
    }
    private function getArticleCountByType(){
        $count[0] = ArticleModel::getArticleCountByType(1);
        $count[1] = ArticleModel::getArticleCountByType(2);
        $this->assign('count',$count);
    }
    private function getNavRecommend(){
        $recommend[0] = ArticleModel::getArticleInfoByParam('look')->toArray();
        $recommend[1] = ArticleModel::getArticleInfoByParam('create_time')->toArray();
        $this->assign('recommend',$recommend);
    }
}
