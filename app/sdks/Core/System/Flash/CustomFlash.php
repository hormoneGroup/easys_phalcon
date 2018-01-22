<?php

namespace App\Sdks\Core\System\Flash;

use App\Sdks\Library\Helpers\CommonHelper;
use Phalcon\Flash\Direct;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Di;
use App\Sdks\Library\Helpers\DiHelper;

/**
 * 输出类库
 *
 * @author dusong<1264735045@qq.com>
 */
class CustomFlash extends Direct
{
    /**
     * 输出json
     *
     * @param array   $data
     * @param int     $code
     * @param string  $msg
     */
    protected function outputJson($data, $code, $msg)
    {
        // 设置返回头
        $response = new Response();

        $response->setContentType('application/json', 'UTF-8');

        if (!empty($data)) {
            $data = CommonHelper::beforeJsonEncode($data, false, true);
        } else {
            $data = new \stdClass();
        }

        $message = CommonHelper::jsonEncode(
            [
                'code'  => strval($code),
                'msg'   => $msg,
                'body'  => $data,
            ], false
        );

        $response->send();

        // 关闭模板渲染
        if (Di::getDefault()->has('view')) {
            DiHelper::getShared('view')->disable();
        }

        $this->setAutoescape(false);
        $this->setAutomaticHtml(false);

        if ($code === 0) {
            $this->success($message);
        } else {
            $this->error($message);
        }
    }

    /**
     * 输出成功信息
     *
     * @param  array  $data
     * @param  int    $code
     * @param  string $msg
     */
    public function successJson($data = [], $code = 0, $msg = 'ok')
    {
        $this->outputJson($data, $code, $msg);
    }

    /**
     * 输出错误信息
     *
     * @param  array  $data
     * @param  int    $code
     * @param  string $msg
     */
    public function errorJson($data = [], $code = -1, $msg = 'error')
    {
        $this->outputJson($data, $code, $msg);
    }
}
