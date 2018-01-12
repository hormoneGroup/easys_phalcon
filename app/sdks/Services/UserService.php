<?php

namespace App\Sdks\Services;

use App\Sdks\Models\Logic\UserLogic;

/**
 * 用户服务
 *
 * @author dusong <1264735045@qq.com>
 */
class UserService extends BaseService
{
    /**
     * 获取UserLogic类
     *
     * @return UserLogic
     */
    protected static function getUserLogic()
    {
        return new UserLogic();
    }


    /**
     * 用户注册
     *
     * @param  array $data
     * @return array
     */
    public static function register(array $data) : array
    {
        return static::getUserLogic()->register($data);
    }

    /**
     * 用户登录
     *
     * @param  array  $data
     * @return array
     */
    public static function login(array $data) : array
    {
        return static::getUserLogic()->login($data);
    }

    /**
     * 获取用户信息
     *
     * @param  int  $uid
     * @return array
     */
    public static function getUserInfo(int $uid) : array
    {
        return static::getUserLogic()->getUserInfo($uid);
    }

}
