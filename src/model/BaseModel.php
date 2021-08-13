<?php
/**
 *  @department : Commercial development.
 *  @description : This file is part of [DZ WXH5_APP_BACKSTAGE].
 *  DZ all rights reserved.
 */

namespace Demo\model;

use Demo\common\Exceptions\DbError;
use think\Model;

/**
 * 系统业务主体表.
 */
class BaseModel extends Model
{
    protected $autoWriteTimestamp = false;

    //定义获取器无法获取返回的状态
    protected $unknownStatus = '未知';

    //定义获取器无法获取返回的时间
    protected $unknownTime = '暂无';

    //设置当前模型的数据库连接
    protected $connection = 'mysql_ms_inner';

    /**
     * 综合判断对象是否为空
     */
    public static function isEmptyData($data = [])
    {
        if (gettype($data) == 'object') {
            //判断是否结果集, 进行结果集转化
            if (method_exists($data, 'isEmpty')) {
                return $data->isEmpty();
            }
        }

        return empty($data);
    }
}
