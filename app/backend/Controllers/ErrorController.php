<?php

/**
 * 错误控制器
 *
 * @author dusong <1264735045@qq.com>
 */

use App\Backend\Controllers\BaseController;

class ErrorController extends BaseController
{

    public function err404Action()
    {
        echo "err404";die;
    }

}
