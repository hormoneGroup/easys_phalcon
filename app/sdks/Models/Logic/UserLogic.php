<?php

/**
 * 用户逻辑
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Sdks\Models\Logic;

use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Helpers\IdHelper;
use App\Sdks\Models\Dao\UserDao;

class UserLogic extends BaseLogic
{

    /**
     * 获取UserDao类
     *
     * @return UserDao
     */
    protected function getUserDao()
    {
        return new UserDao();
    }

    /**
     * 注册用户
     *
     * @param  array $data
     * @return array
     */
    public function register(array $data) : array
    {
        $user_dao = $this->getUserDao();

        $exist = $user_dao->checkByNameExist($data['user_name']);
        if ($exist) {
            ErrorHandle::throwErr(Err::create(CoreLogic::USER_REGISTER_USERNAME_EXIST));
        }

        // 注册数据
        $register_data = [
            'uid'         => IdHelper::getNextId(),
            'user_name'   => $data['user_name'],
            'password'    => static::generatePassword($data['password']),
            'create_time' => time(),
            'is_deleted'  => 0,
        ];

        $res = $user_dao->register($register_data);
        if (!$res) {
            ErrorHandle::throwErr(Err::create(CoreLogic::USER_REGISTER_ERROR));
        }

        // 注册成功逻辑

        return [
            'uid' => $register_data['uid'],
        ];
    }

    /**
     * 获取用户信息
     *
     * @param  int  $uid
     * @return array
     */
    public function getUserInfo(int $uid) : array
    {
        $ret = [
            'user' => $this->getUserDao()->getByUidUserInfo($uid)
        ];

        return $ret;
    }

    /**
     * 获取用户信息
     *
     * @param  array  $data
     * @return array
     */
    public function login(array $data) : array
    {
        $user = $this->getUserDao()->getByNameUserInfo($data['user_name']);
        if (!$user) {
            ErrorHandle::throwErr(Err::create(CoreLogic::USER_LOGIN_USERNAME_ERROR));
        }

        if (!static::checkPassword($data['password'], $user['password'])) {
            ErrorHandle::throwErr(Err::create(CoreLogic::USER_LOGIN_PASSWORD_ERROR));
        }

        $ret = [
            'uid' => $user['uid']
        ];

        return $ret;
    }

}
