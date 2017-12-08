<?php

/**
 * 系统相关错误类
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Sdks\Library\Error\Handlers;

use App\Sdks\Library\Error\Settings\System;

class SysErr extends Err implements ErrInterface
{
    /**
     * 构造函数
     *
     * @param int  $code
     * @param null $custom_info
     */
    public function __construct($code, $custom_info = null)
    {
        parent::__construct($code, $custom_info);

        $this->msgs  = System::$MSGS;
    }

    /**
     * 记录log并抛出异常
     */
    public function handle()
    {
        $this->handleError();
    }

}
