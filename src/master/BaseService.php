<?php

namespace Demo\master;

use Demo\common\Application;

/**
 * 基础服务.
 */
class BaseService
{
    /**
     * 容器实例.
     */
    protected $_app;

    /**
     * 容器初始化输入参数.
     */
    protected $_inputConfig;

    /**
     * 验证器.
     */
    protected $_validator;

    /**
     * 容器初始化redis客户端.
     */
    protected $_cache;

    /**
     * 通用redis客户端过期时间.
     */
    protected $_rds_data_expire = 7200;

    /**
     * 容器初始化Mysql连接.
     */
    protected $_dbconn;

    public function __construct(Application $app)
    {
        //初始化使用到的必须依赖
        $this->_app         = $app;
        $this->_inputConfig = $app['config'];
        $this->_validator   = $app['validator'];
        $this->_cache       = $app['cache'];
        $this->_dbconn      = $app['dbcon_handler']->_connectInfo;
    }

    /**
     * 标准返回方法, 全部规范为数组返回.
     */
    public function formatReturn($data)
    {
        if (empty($data)) {
            return [];
        }

        if (gettype($data) == 'object') {
            //判断是否结果集, 进行结果集转化
            if (method_exists($data, 'isEmpty')) {
                if ($data->isEmpty()) {
                    return [];
                }
            }

            //判断是否结果集, 进行结果集转化
            if (method_exists($data, 'toArray')) {
                return $data->toArray();
            }
        }

        return $data;
    }
}
