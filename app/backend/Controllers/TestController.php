<?php

use App\Backend\Controllers\BaseController;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Services\UserService;

/**
 * 测试控制器
 *
 * @author dusong<1264735045@qq.com>
 */
class TestController extends BaseController
{
    /**
     * @throws JsonFmtException
     */
    public function indexAction()
    {
        try {
            $res = \App\Sdks\Library\Helpers\MailHelper::send('test', 'xx', [
                [
                    'mail' => '1264735045@qq.com',
                    'name' => '1264735045@qq.com',
                ]
            ]);
            var_dump($res);
            $this->flash->successJson('test');
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

}
