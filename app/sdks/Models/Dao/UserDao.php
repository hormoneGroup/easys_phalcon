<?php

/**
 * 用户数据路由层
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Sdks\Models\Dao;

use App\Sdks\Models\Entity\Mongo\UserEntity;

class UserDao extends BaseDao
{

    /**
     * 获取实体类
     *
     * @return UserEntity
     */
    protected function getEntity()
    {
        return new UserEntity();
    }

    /**
     * 注册用户
     *
     * @param  array $data
     * @return bool
     */
    public function register(array $data) : bool
    {
        return $this->getEntity()->register($data);
    }

    /**
     * 根据用户ID获取信息
     *
     * @param  int  $uid
     * @return array
     */
    public function getByUidUserInfo(int $uid) : array
    {
        return $this->getEntity()->getByUidUserInfo($uid);
    }

    /**
     * 根据用户名获取信息
     *
     * @param  string  $user_name
     * @return array
     */
    public function getByNameUserInfo(string $user_name) : array
    {
        return $this->getEntity()->getByNameUserInfo($user_name);
    }

    /**
     * 检查用户名是否存在
     *
     * @param  string  $user_name
     * @return bool
     */
    public function checkByNameExist(string $user_name) : bool
    {
        return $this->getEntity()->checkByNameExist($user_name);
    }

}
