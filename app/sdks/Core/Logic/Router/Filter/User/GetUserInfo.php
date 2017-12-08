<?php

/**
 * 用户信息过滤器
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Sdks\Core\Logic\Router\Filter\User;

use  App\Sdks\Core\Logic\Router\Filter\BaseFilter;

class GetUserInfo extends BaseFilter
{

    public function rules()
    {
        return [
            ['uid', 'int|trim'],
        ];
    }
}