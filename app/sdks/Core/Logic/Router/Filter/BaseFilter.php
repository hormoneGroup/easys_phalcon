<?php

namespace App\Sdks\Core\Logic\Router\Filter;

use Inhere\Validate\Filter\Filtration;

/**
 * 路由过滤器基类
 *
 * @author dusong<1264735045@qq.com>
 * @link https://github.com/inhere/php-validate#built-in-validators
 */
class BaseFilter extends Filtration
{
    /**
     * 过滤数据
     *
     * @param  array $data
     * @return array
     */
    public function filters(array $data)
    {
        return $this->load($data)->filtering($this->rules());
    }
}
