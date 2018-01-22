<?php

namespace App\Sdks\Library\Helpers;

use Phalcon\Di;

/**
 * DI容器类库
 *
 * @author dusong<1264735045@qq.com>
 */
class DiHelper
{
    /**
     * 获取全局共享的DI服务
     *
     * @param  string  $name
     * @return object
     */
    public static function getShared($name)
    {
        return Di::getDefault()->getShared($name);
    }

    /**
     * 获取全局配置
     *
     * @return object
     */
    public static function getSharedConfig()
    {
        return self::getShared('config');
    }

}