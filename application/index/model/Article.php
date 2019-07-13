<?php
/**
 * Created by PhpStorm.
 * User: jakin
 * Date: 2019/7/6
 * Time: 21:55
 */
namespace app\index\model;

use think\model\concern\SoftDelete;

class Article extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $hidden = ['delete_time'];
    public function imageList(){
        return $this->belongsToMany('Image','article_image','img_id','article_id');
    }
    public function getCreateTimeAttr($value)
    {
        return date('Y-m-d H:i:s',$value);
    }
    public function getStatusAttr($value)
    {
        $data = ['隐藏','显示'];
        return $data[$value];
    }
    public function getTypeAttr($value)
    {
        $data = '';
        if ($value == 1){
            $data = '学无止境';
        }elseif($value == 2){
            $data = '博客日记';
        }
        return $data;
    }
    public static function getArticleList(){
        $articleList = self::with(['imageList'])
            ->order('create_time','DESC')
            ->limit(0,10)
            ->select();
        return $articleList;
    }
    public static function getArticleCountByType($type){
        $count = self::where('type','=',$type)->count();
        return $count;
    }
    public static function getArticleInfoByParam($param){
        $article = self::field(['id','title'])
            ->order($param,'DESC')
            ->limit(0,5)
            ->select();
        return $article;
    }
    public static function getArticleInfoByType($type){
        $data = ['学无止境'=>1,'博客日记'=>2];
        $article = self::field(['id','title'])
            ->where('type','=',$data[$type])
            ->order('create_time','DESC')
            ->limit(0,5)
            ->select();
        return $article;
    }
}