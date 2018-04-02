<?php
/**
 * 顶层Controller
 */
namespace App\common;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    //初始化方法
    public function initialize()
    {

    }

    /* 通用错误代码定义 */
    const SUCCEED = 0;   // 成功
    const ERROR   = 500; // 错误

    /**
     * AJAX 响应数据 (JSON格式)
     *
     * @param  integer $code                      响应代码
     * @param  string  $message                   响应消息
     * @param  mixed   $data                      响应数据
     * @return json    包含响应的时间戳
     */
    protected function ajaxReturn($code, $message = '', $data = null)
    {
        $result = [
            'code'      => (int) $code,
            'message'   => $message,
            'data'      => $data,
            'timestamp' => time(),
        ];

        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);exit;
    }

    /**
     * 响应成功信息
     *
     * @param string $message
     * @param array  $data
     */
    protected function success($data = null, $message = null, $code = self::SUCCEED)
    {
        return $this->ajaxReturn($code, $message, $data);
    }

    /**
     * 响应错误信息
     *
     * @param string $message
     * @param array  $data
     */
    protected function error($code = self::ERROR, $message = null, $data = null)
    {
        return $this->ajaxReturn($code, $message, $data);
    }

}
