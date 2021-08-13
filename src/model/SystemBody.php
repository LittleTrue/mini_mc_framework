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
 * 系统业务主体表(Demo).
 */
class SystemBody extends BaseModel
{
    //模型表
    protected $name = 'system_body';

    /**
     * 获取对应系统的主体body_id对应的系统字段信息.
     */
    public static function getBodyInfo($body_id)
    {
        $body_info = self::where('id', $body_id)->find();

        if (self::isEmptyData($body_info)) {
            throw new DbError('empty body info');
        }

        $body_arr['body_name']  = $body_info['body_name'];
        $body_arr['body_index'] = $body_info['body_sys_key'];

        return $body_arr;
    }
}
