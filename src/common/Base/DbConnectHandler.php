<?php

namespace Demo\common\Base;

use Demo\common\Application;
use Demo\common\Exceptions\DbError;
use think\DbManager;

/**
 * 进行数据库连接初始化、连接、关闭等操作.
 * 目前只支持单个数据连接.
 */
class DbConnectHandler
{
    //连接信息
    public $_connectInfo;

    //数据库类型
    private $_dbType = 'mysql';

    //数据库字符集
    private $_charset = 'utf8';

    //注入配置信息
    private $_config;

    /**
     * 使用容器注入的参数初始化redis.
     */
    public function __construct(Application $app)
    {
        $this->_config = $app['config'];

        //获取必须参数
        $db_host   = $this->_config['host'];
        $user_name = $this->_config['user_name'];
        $password  = $this->_config['password'];
        $db_name   = $this->_config['db_name'];
        $db_prefix = $this->_config['db_prefix'];
        $database = $this->_config['database'];

        if (empty($db_host) || empty($user_name) || empty($password) || empty($db_name)|| empty($database)) {
            throw new DbError('db config error');
        }

        //局部实例化数据库使用
        $this->_connectInfo = [
            // 数据库类型
            'type' => $this->_dbType,
            // 主机地址
            'hostname' => $db_host,
            // 用户名
            'username' => $user_name,
            // 数据库密码
            'password' => $password,
            // 数据库名
            'database' => $database,
            // 数据库编码默认采用utf8
            'charset' => $this->_charset,
            // 数据库表前缀
            'prefix' => $db_prefix,
            // 数据库调试模式
            'debug' => true,
        ];

        // 数据库配置信息设置（全局有效, 和上层TP的单例共享）
        $db_obj = new DbManager();

        $db_obj->setConfig([
            //默认数据库
            'default' => 'mysql_ms_inner',

            // 数据库连接信息
            'connections' => [
                'mysql_ms_inner' => [
                    // 数据库类型
                    'type' => $this->_dbType,
                    // 主机地址
                    'hostname' => $db_host,
                    // 用户名
                    'username' => $user_name,
                    // 数据库密码
                    'password' => $password,
                    // 数据库名
                    'database' => $database,
                    // 数据库编码默认采用utf8
                    'charset' => $this->_charset,
                    // 数据库表前缀
                    'prefix' => $db_prefix,
                    // 数据库调试模式
                    'debug' => true,
                ],
            ],
        ]);
    }
}
