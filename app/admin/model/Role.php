<?php


namespace app\admin\model;

use think\Model as ThinkModel;

class Role extends ThinkModel
{
    // 设置当前模型对应的完整数据表名称
    protected $name = 'admin_role';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
}