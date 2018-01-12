<?php

namespace App\Sdks\Models\Entity\Mysql;

/**
 * 用户实体
 *
 * @author    dusong <1264735045@qq.com>
 */
class UserEntity extends MysqlEntity
{

    public $id;

    public $name;

    public $password;

    public function getSource()
    {
        return "info_user";
    }

    /**
     * 获取错误信息
     *
     * @return array
     */
    public function getErrorMessages()
    {
        $errors = [];
        if ($messages = $this->getMessages()) {
            foreach ($messages as $message) {
                $errors[$message->getField()] = $message->getMessage();
            }
        }

        return $errors;
    }

    /**
     * 注册用户
     *
     * @param  array  $data
     * @return bool
     */
    public function register(array $data)
    {
        return $this->save($data);
    }

    /**
     * 获取用户信息
     *
     * @param  int  $uid
     * @return array
     */
    public static function getUserInfo($uid)
    {
        return [
            'name'         => 'dusong',
            'create_time'  => time(),
        ];
    }

}
