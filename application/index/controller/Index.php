<?php
namespace app\index\controller;

use app\index\model\Article as ArticleModel;

class Index extends BaseController
{
    private $count;
    public function index()
    {
        $articleList = $this->getArticleList();
        //return json($articleList);
        $this->assign('count',$this->count);
        $this->assign("articleList",$articleList);
        return $this->fetch('index');
    }
    public function getArticleInfo($id)
    {
        $article = ArticleModel::get($id-1024);
        $info = $article->hidden(['status','update_time'])->toArray();
        //return json($info);
        $this->assign("info",$info);
        return $this->fetch('blog');
    }
    private function getArticleList(){
        $article = ArticleModel::getArticleList();
        $articleList = $article->hidden(['content','image_list.pivot','status','update_time'])->toArray();
        $i = 0;
        foreach ($articleList as $key=> $value){
            if ($value['type'] == '学无止境'){
                $i++;
            }
        }
        $this->count = [$i,count($articleList)-$i];
        return $articleList;
    }
}
