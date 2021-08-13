<?php

namespace Demo\master;


/**
 * DEMO
 */
class DemoHandler extends BaseService
{
    /**
     * 获取当前所有的接口场景列表.
     *
     * @param string $business_sign 系统业务场景
     * @param string $body_content  业务主体
     */
    public function getApiSceneList($business_sign, $body_content)
    {
        //判断是否有适用的查询
        $cache = $this->_cache->get($business_sign . $body_content);

        if (!empty($cache)) {
            return $cache;
        }
        
        //TODO ---

        return $this->formatReturn($api_list);
    }
}
