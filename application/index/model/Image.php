<?php
/**
 * Created by PhpStorm.
 * User: jakin
 * Date: 2019/4/28
 * Time: 14:16
 */

namespace app\index\model;

use think\model\concern\SoftDelete;

class Image extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $hidden = ['from','description','create_time','delete_time','update_time'];

    public function getUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }
    public function getFromAttr($value)
    {
        $data = ['网络','本地'];
        return $data[$value];
    }
    public function getCreateTimeAttr($value)
    {
        if ($value != null){
            return date('Y-m-d',$value);
        }
        return $value;
    }
}