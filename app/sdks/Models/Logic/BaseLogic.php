<?php

/**
 * 逻辑层基类
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Sdks\Models\Logic;

use App\Sdks\Library\Helpers\DiHelper;

class BaseLogic
{

    /**
     * 获取全局共享的DI服务
     *
     * @param  string $name
     * @return mixed
     */
    protected static function getShared($name)
    {
        return DiHelper::getShared($name);
    }

    /**
     * 获取配置
     *
     * @return mixed
     */
    protected static function getSharedConfig()
    {
        return DiHelper::getSharedConfig();
    }

    /**
     * 生成密码
     *
     * @param  mixed  $password
     * @return string
     */
    protected static function generatePassword($password)
    {
        return self::getShared('security')->hash(md5($password));
    }

    /**
     * 验证密码
     *
     * @param  string $password
     * @param  string $password_hash
     * @return bool
     */
    protected static function checkPassword($password, $password_hash)
    {
        return self::getShared('security')->checkHash(md5($password), $password_hash);
    }

}
