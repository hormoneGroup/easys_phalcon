<?php

namespace App\Sdks\Core\Logic\Router\Validate;

use Inhere\Validate\Validation;

/**
 * 路由验证器基类
 *
 * @author dusong<1264735045@qq.com>
 * @link https://github.com/inhere/php-validate#built-in-validators
 */
class BsseValidate extends Validation
{
    /**
     * 验证数据
     *
     * @param  array $data
     * @return array
     */
    public function validations(array $data)
    {
        return static::make($data)->validate();
    }
}
