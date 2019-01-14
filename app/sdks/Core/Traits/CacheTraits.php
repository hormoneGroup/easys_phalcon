<?php

namespace App\Sdks\Core\Traits;

use App\Sdks\Library\Constants\CacheConfig;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\Handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Library\Helpers\CacheHelper;
use App\Sdks\Library\Helpers\CommonHelper;
use App\Sdks\Library\Helpers\DiHelper;
use Phalcon\Di;

/**
 * 缓存助手
 *
 * @author dusong<1264735045@qq.com>
 */
trait CacheTraits
{
    /**
     * 获取类父级配置
     *
     * @param  string $class
     * @param  string $method
     * @return string
     */
    protected static function getClassParentsKey(string $class, string $method)
    {
        $key = '';
        $ancestors = CommonHelper::getParentsOfClass($class);
        foreach ($ancestors as $ancestor) {
            $class_str = str_replace('\\\\','\\',$ancestor ). '::' . $method;
            if (array_key_exists($class_str, CacheConfig::$SETTINGS)) {
                $key = $ancestor . '::' . $method;
                break;
            }
        }

        return $key;
    }

    /**
     * 缓存存取
     *
     * @param  object $class
     * @param  string $method
     * @param  array  $arguments
     * @return mixed
     */
    private static function wrapGetCache($class, $method, $arguments)
    {
        // 获取缓存配置
        $class_origin = $class;
        $class        = is_object($class) ? get_class($class) : $class;
        $key          = $class . '::' . $method;

        // 判断所有父类名是否已经存在配置中
        $has_setting = true;
        if (!array_key_exists($key, CacheConfig::$SETTINGS)) {
            $parent_key = static::getClassParentsKey($class, $method);
            if ($parent_key) {
                $key = $parent_key;
            } else {
                $has_setting = false;
            }
        }

        if (!$has_setting) {
            // todo 记录异常信息
            ErrorHandle::throwErr(Err::create(CoreLogic::CACHE_ERROR));
        }

        $settings   = CacheConfig::$SETTINGS[$key];
        $cache_time = CacheHelper::expire($key);

        // 如果存在自定义key，则使用自定义key
        if (isset($settings['custom_key'])) {
            $key = $settings['custom_key'];
        }

        $cache     = DiHelper::getShared('redis');
        $cache_key = md5(sprintf("{$key}||%s", CommonHelper::jsonEncode($arguments)));

        $ret = $cache->get($cache_key);

        if (!$ret) {
            $ret = CommonHelper::callMethod($class_origin, $method, $arguments);
            $cache->set($cache_key, $ret, $cache_time);
        }

        return $ret;
    }

    /**
     * 缓存删除
     *
     * @param  object $class
     * @param  string $method
     * @param  array  $arguments
     * @return mixed
     */
    private static function wrapDelCache($class, $method, $arguments)
    {
        // 获取缓存配置
        $class = is_object($class) ? get_class($class) : $class;
        $key   = $class . '::' . $method;

        // 判断所有父类名是否已经存在配置中
        $has_setting = true;
        if (!array_key_exists($key, CacheConfig::$SETTINGS)) {
            $parent_key = static::getClassParentsKey($class, $method);
            if ($parent_key) {
                $key = $parent_key;
            } else {
                $has_setting = false;
            }
        }

        if (!$has_setting) {
            // todo 记录异常信息
            ErrorHandle::throwErr(Err::create(CoreLogic::CACHE_ERROR));
        }

        $settings = CacheConfig::$SETTINGS[$key];

        // 如果存在自定义key，则使用自定义key
        if (isset($settings['custom_key'])) {
            $key = $settings['custom_key'];
        }

        $cache     = DiHelper::getShared('redis');
        $cache_key = md5(sprintf("{$key}||%s", CommonHelper::jsonEncode($arguments)));

        $ret = $cache->delete($cache_key);

        return $ret;
    }

    /**
     * 自动调用类的普通方法
     *
     * @param  string  $name
     * @param  array   $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        $class  = $this;
        $method = $name;

        // 封装存取缓存
        if (preg_match('#(.+)FromCache$#', $name, $match)) {
            return static::wrapGetCache($class, $match[1], $arguments);
        }

        // 封装删除缓存
        if (preg_match('#(.+)DelCache$#', $name, $match)) {
            return static::wrapDelCache($class, $match[1], $arguments);
        }

        if (method_exists($class, $method)) {
            return $class->$method($arguments);
        } else {
            $class = get_class($class);
            trigger_error("Call to undefined method {$class}->{$method}()", E_USER_ERROR);
        }
    }

    /**
     * 自动调用类的静态方法
     *
     * @param  string  $name
     * @param  array   $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $class  = get_called_class();
        $method = $name;

        // 封装存取缓存
        if (preg_match('#(.+)FromCache$#', $name, $match)) {
            return static::wrapGetCache($class, $match[1], $arguments);
        }

        // 封装删除缓存
        if (preg_match('#(.+)DelCache$#', $name, $match)) {
            return static::wrapDelCache($class, $match[1], $arguments);
        }

        if (method_exists($class, $method)) {
            return $class::$method($arguments);
        } else {
            trigger_error("Call to undefined method {$class}::{$method}()", E_USER_ERROR);
        }
    }
}
