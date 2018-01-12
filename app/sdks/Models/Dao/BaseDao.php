<?php

namespace App\Sdks\Models\Dao;

/**
 * 数据路由层基类
 *
 * @author dusong <1264735045@qq.com>
 */
class BaseDao
{
    /**
     * 实体类
     *
     * @var array
     */
    //protected static $entity_class = [];

    /**
     * 获取实体类
     *
     * @param mixed  $class
     * @param array  $parameter
     * @param object
     */
    /*protected static function getEntity($class, $parameter = [])
    {
        if (!isset(self::$entity_class[$class])) {
            self::$entity_class[$class] = new $class(...$parameter);
        }

        return self::$entity_class[$class];
    }*/
}
