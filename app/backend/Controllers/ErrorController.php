<?php

use App\Backend\Controllers\BaseController;

/**
 * 错误控制器
 *
 * @author dusong <1264735045@qq.com>
 */
class ErrorController extends BaseController
{
    public function err404Action()
    {
        echo "err404";die;
    }

}
