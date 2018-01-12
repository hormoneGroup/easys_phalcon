<?php

use App\Backend\Controllers\BaseController;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Services\UserService;

/**
 * 用户控制器
 *
 * @author dusong <1264735045@qq.com>
 */
class UserController extends BaseController
{
    /**
     * 注册用户
     *
     * @throws JsonFmtException
     */
    public function registerAction()
    {
        try {
            $data = [
                'user_name' => $this->request->getPost('user_name'),
                'password'  => $this->request->getPost('password'),
            ];
            $ret = UserService::register($data);

            $this->flash->successJson($ret);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 获取用户信息
     *
     * @throws JsonFmtException
     */
    public function loginAction()
    {
        try {
            $data = [
                'user_name' => $this->request->getPost('user_name'),
                'password'  => $this->request->getPost('password'),
            ];
            $ret = UserService::login($data);

            $this->flash->successJson($ret);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 获取用户信息
     *
     * @throws JsonFmtException
     */
    public function getUserInfoAction()
    {
        try {
            $uid = $this->request->getPost('uid');
            $ret = UserService::getUserInfo($uid);

            $this->flash->successJson($ret);
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

}
