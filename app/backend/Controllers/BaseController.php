<?php

/**
 * 控制器基类
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Backend\Controllers;

use App\Sdks\Core\System\Controllers\PhalBaseController;

class BaseController extends PhalBaseController
{

    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();
    }

    public function initialize()
    {
        parent::initialize();
    }
}
