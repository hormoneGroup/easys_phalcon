<?php

use App\Backend\Controllers\BaseController;
use App\Sdks\Library\Error\Exceptions\CustomException;
use App\Sdks\Library\Exceptions\JsonFmtException;
use App\Sdks\Library\Error\ErrorHandle;
use App\Sdks\Library\Error\handlers\Err;
use App\Sdks\Library\Error\Settings\CoreLogic;
use App\Sdks\Services\UserService;

/**
 * mongo控制器
 *
 * @author dusong<1264735045@qq.com>
 */
class MongoController extends BaseController
{
    /**
     * @throws JsonFmtException
     */
    public function addAction()
    {
        try {
            $data = [
                'name' => 'dusong',
                'sex'  => 1,
                'list' => [
                    1,
                    2,
                ],
                'parent' => [
                    'xx12',
                    'xx2',
                ]
            ];
            $user = new \App\Sdks\Models\Entity\Mongo\UserEntity();
            $res = $user::registerDelCache($data);

            $this->flash->successJson("add user res:{$res}");
        } catch (CustomException $e) {
            throw new JsonFmtException($e->getMessage(), $e->getCode());
        }
    }

}
