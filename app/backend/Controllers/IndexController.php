<?php

use App\Backend\Controllers\BaseController;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Services\UserService;

/**
 * 默认控制器
 *
 * @author dusong<1264735045@qq.com>
 */
class IndexController extends BaseController
{
    /**
     * @throws JsonFmtException
     */
    public function indexAction()
    {
        /*
         * 控制器层(controller) 调用服务层
         * 服务层(service)      调用逻辑层(调用多个逻辑层)
         * 逻辑层(logic)        调用数据路由层(调用多个数据路由层)
         * 逻辑层(dao)          调用实体层
         * 实体层(entity)       无调用
         */
        try {
            $this->flash->successJson('hello world!');
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

}
