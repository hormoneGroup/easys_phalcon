<?php

/**
 * 测试task
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Tasks\Backend;

class TestTask extends BaseTask
{

    public function indexAction()
    {
        echo __CLASS__;
    }
}
