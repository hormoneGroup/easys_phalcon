<?php

namespace App\Sdks\Models\Entity\Mysql;

use Phalcon\Mvc\Model;
use App\Sdks\Core\Traits\CacheTraits;

/**
 * mysql实体层基类
 *
 * @author dusong<1264735045@qq.com>
 */
class MysqlEntity extends Model
{
    use CacheTraits;
}
