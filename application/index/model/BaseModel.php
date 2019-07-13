<?php

namespace app\index\model;

use think\Model;
use think\facade\Config;

class BaseModel extends Model
{
    protected function prefixImgUrl($value,$data)
    {
        $finalUrl = $value;
        if ($data['from'] == 1){
            $finalUrl = Config::get('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
