<?php

/**
 * 用户注册过滤器
 *
 * @author dusong <1264735045@qq.com>
 */

namespace App\Sdks\Core\Logic\Router\Filter\User;

use  App\Sdks\Core\Logic\Router\Filter\BaseFilter;

class Register extends BaseFilter
{

    public function rules()
    {
        return [
            ['user_name', 'string|specialChars|trim'],
            ['password', 'string|specialChars|trim'],
        ];
    }
}