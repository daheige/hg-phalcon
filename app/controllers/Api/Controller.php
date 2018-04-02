<?php
namespace Api;

use App\common\ControllerBase;

class Controller extends ControllerBase
{
    // 前置初始化方法
    public function initialize()
    {
        $this->view->disable();
    }
}
