<?php

namespace App\Sdks\Library\Constants;

/**
 * 缓存配置
 *
 * @author dusong<1264735045@qq.com>
 */
class CacheConfig
{
    // 默认缓存时间(秒)
    const DEFAULT_EXPIRE_TIME = 3600;

    /**
     * 缓存设置
     *
     * @var array
     */
    public static $SETTINGS = [
        'App\Sdks\Models\Entity\Mongo\UserEntity::register' => [
            'expire_time' => 10800,
        ],
    ];
}
